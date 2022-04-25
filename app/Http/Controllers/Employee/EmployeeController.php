<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        switch ($request->trnmode) {  
            case 'fetchEmployee': 
                $data =  $this->fetchEmployee($request);
               break; 
            case 'storeEmployee': 
                $data =  $this->storeEmployee($request);
               break; 
            // case 'updateUser': 
            //     $data =  $this->updateUser($request);
            //    break; 
            // case 'deleteUser': 
            //      $data =  $this->deleteUser($request);
            //     break; 
            default:
                 return \response()->json(['error'=>'something error'],400);
                break;

        }
        
        if(isset($data['error'])){
              return \response()->json($data, 400);
        }
        return \response()->json($data,200);
    }
    private function storeEmployee($request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg'
         ]);
         
         if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
        }
        
        return $file_path;
        
        
            // $emp->id = $request->id;
            // $emp->branch_id = $request->branch_id;
            // $emp->emp_id = $request->emp_id;
            // $emp->lastname = $request->lastname;
            // $emp->firstname = $request->firstname;
            // $emp->middlename = $request->middlename;
            // $emp->suffix = $request->suffix;
            // $emp->birthdate = $request->birthdate;
            // $emp->email = $request->email;
            // $emp->mobile = $request->mobile;
            // $emp->religion = $request->religion;
            // $emp->civilstatus = $request->civilstatus;
            // $emp->gender = $request->gender;
            // $emp->status = $request->status;
            // $emp->image = $request->image;
            // $emp->datehired = $request->datehired;
            // $emp->position = $request->position;
            // $emp->department = $request->department;
            // $emp->type = $request->type;
            // $emp->created_by = $request->user_id;
            // $emp->updated_by = $request->user_id;
 
        
    }
    private function fetchEmployee($request)
    {
        
    }
    
    
    
}
