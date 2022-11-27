<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    function fetch_data(Request $request)
    {
     if($request->ajax())
     {  

        $searchArray=[];

       $name=$request->query('name')!=null?$request->query('name'):"";
       $email=$request->query('email')!=null?$request->query('email'):"";
       $role=$request->query('role')!=null?$request->query('role'):"";
       $gender=$request->query('gender')!=null?$request->query('gender'):"";
       
       

        $users = User::where('name','like','%'. $name .'%' )
                ->where('role', 'like','%'. $role .'%')
                ->where('gender','like','%'. $gender .'%' )
                ->where('email', 'like','%'. $email .'%')
                ->paginate(2);
        return view('admin.admindata', compact('users'))->render();
     }
    }
    function ChangeRole(Request $request, $id)
    {
   
        User::where('id',$id)->update(['role'=>$request->role]);
        return "done";
     
    }
}
