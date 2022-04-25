<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request)
    { 
        $data = [];
        switch ($request->trnmode) {  
            case 'fetchUser': 
                $data =  $this->fetchUser($request);
               break; 
            case 'storeUser': 
                $data =  $this->storeUser($request);
               break; 
            case 'updateUser': 
                $data =  $this->updateUser($request);
               break; 
            case 'deleteUser': 
                 $data =  $this->deleteUser($request);
                break; 
            default:
                 return \response()->json(['error'=>'something error'],400);
                break;

        }
        
        if(isset($data['error'])){
              return \response()->json($data, 400);
        }
        return \response()->json($data,200);
    }
    
    private function updateUser($request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'username' => 'required|unique:users,username,'.$request->id,
            // 'usertype' => 'required',
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password == '' ? $user->password : Hash::make($request->password);
        // $user->branch = $request->branch;
        // $user->usertype = $request->usertype; 
        if ($user->save()) {

            if ($request->role) {
                $user->syncRoles($request->role);
                $user->syncBranch()->sync($request->branch);
            }

        }

        return $user;  
    }
    
    private function storeUser($request)
    {
        $data = '';
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'role' => 'required', 
            // 'branch' => 'required',
            // 'usertype' => 'required',
        ],[
            'name.required' => 'The Name field is required.',
            'email.required' => 'The Email field is required.',
            'username.required' => 'The Username field is required.',
            'password.required' => 'The Password field is required.',
            'role.required' => 'The Role field is required.',
            'email.email' => 'The Email must be a valid email address.',
            'password.min' => 'The password must be at least 6 characters.',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // $user->branch = $request->branch;
        $user->status = '01';

        if ($user->save()) {
            if ($request->role) {
                $user->syncRoles($request->role);
                $user->syncBranch()->sync($request->branch);
            } 
        } 
         return $user;  
    }
    
    private function deleteUser(Request $request)
    {
       $data =  User::where('id',$request->id)->update(['status' => '99']); 
        return $data;
    }
    
    private function fetchUser($request)
    {
        $data = [];
        switch ($request->trntype) {  
            case 'get': 
                $data =  User::with(['roles','mybranch'])->get();
               break; 
            case 'search': 
                 $data =  User::where('id',$request->id)->with('roles')->first();
                break; 
            default:      
                $data =  User::with('roles')->get();
            break; 
             

        } 
         
        return $data;
    }
    
    
}
