<?php

namespace App\Http\Controllers\Acl;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResources;

class AclController extends Controller
{
    public function index(Request $request)
    {
        $data =[]; 
        switch ($request->trnmode) { 
            case 'fetchRole':
                $data = $this->fetchRole($request);
                break;
            case 'fetchPermissions':
                $data = $this->fetchPermissions($request);
                break;
            case 'storeRole':
                $data = $this->storeRole($request);
                break;
            case 'deleteRole':
                $data = $this->deleteRole($request);
                break;  
            // case 'getPermission':
            //     $data = $this->getPermission($request);
            //     break; 
            // default:
            //     //   $data = '';
            //     break;
        }
        
        if(isset($data['error'])){
              return \response()->json($data, 400);
        }
        return \response()->json($data);
    }
    
    public function updateRole($request)
    { 
    
        DB::beginTransaction(); 
        try {
            $this->validate($request,  [
                'display_name' => 'required|min:4|unique:roles,id,'.$request->id,
                'name' => 'required|min:4|unique:roles,id,'.$request->id,
                ],[
                     'display_name.required' => 'Display name is required',
                    'name.required' => 'Slug is required',
                    'description.required' => 'Description is required',
                    'display_name.unique' => 'Display name is already exist',
                    'name.unique' => 'Slug is already exist',
                ]);
                
            $role = Role::findOrFail($request->id);
            $role->display_name = $request->display_name;
            $role->description = $request->description; 
            if ($role->save()) {
                $role->syncPermissions($request->permission);
            } 
            DB::commit();
            return  $request;
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
    
    private function deleteRole($request)
    {
        DB::beginTransaction(); 
        try {
            Role::destroy($request->id);
            DB::commit();
            return 'successfully removed'; 
            
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
    
    private function storeRole($request)
    {
        DB::beginTransaction();

        try {
        $this->validate($request,  [
            'display_name' => 'required|min:4|unique:roles',
            'name' => 'required|min:4|unique:roles', 
            ],[
                 'display_name.required' => 'Display name is required',
                'name.required' => 'Slug is required',
                'description.required' => 'Description is required',
                'display_name.unique' => 'Display name is already exist',
                'name.unique' => 'Slug is already exist',
            ]);
    
            $role = new Role();
            $role->display_name = $request->display_name;
            $role->name = Str::replace(' ', '_',$request->name);
            $role->description = $request->description;

            if ($role->save()) {
                $role->syncPermissions($request->permission);
            } 
            DB::commit();
            return 'successfully insert new role'; 
            
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
    private function fetchRole($request)
    {
        $data = ''; 
                 $data = Role::with(['permissions' => function ($q) {
                $q->pluck('id');
                }])->get();
                
       return  $data;
    }
    
    private function fetchPermissions($request)
    { 
        $data = '';
        switch ($request->trntype) {
            case 'get':
                 $data = Permission::when($request->id,function($q) use($request){
                     $q->where('id',$request->id);
                 })->get();
                break; 
            default:
                 $data = Permission::get();
                break;
        }

       return $data;
    }
}