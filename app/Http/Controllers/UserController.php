<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function allusers(){

        $users = User::paginate(20);

        return view('admin/allusers',['u'=>$users]);
    }



    public function edituserview( User $users){



        return view('admin/editview',['u'=>$users]);
    }



    public function edit( User $users, Request $request){
  
        $ext=$request->file('image')->getClientOriginalExtension();
        $filename= \Str::slug($request->title).time().'.'.$ext;
        $request->image->move(public_path('User-image'), $filename);

        $users->name =$request->name;
        $users->code =$request->code;
        $users->email =$request->email;
        $users->image =$filename;

        $users->save($request->except(['password']));


        return back();
    }



    public function destroy(Request $request, User $users){


        $check =Auth::user()->code;
        if ($check == 007) {

            $users->delete();
            return back();
        }
            return back();

    }




}
