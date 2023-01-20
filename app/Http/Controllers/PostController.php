<?php

namespace App\Http\Controllers;

use App\Models\Blog;

use App\Models\CatTag;
use App\Models\Research;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


    public function blog()
    {
        return view('admin/addblog');
    }

    public function research()
    {
        return view('admin/addresearch');
    }

    public function addpost(Request $request, Blog $blog){

        $ext =$request->file('image')->getClientOriginalExtension();
        $filename= \Str::slug($request->title).time().'.'.$ext;
        $request->image->move(public_path('Blog-image'), $filename);


        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->tags = $request->tags;
        $blog->author = $request->author;
        $blog->user_id = Auth::user()->id;
        $blog->images = $filename;
        $blog->save();
        return back();


    }



    public function addresearch(Request $request){


        $ext= $request->file('image')->getClientOriginalExtension();
        $filename = \Str::slug($request->title).time().'.'.$ext;
        $request->image->move(public_path('Research-image') , $filename);


        $research =new Research();
        $research->image =$filename;
        $research->title =$request->title;
        $research->content =$request->content;
        $research->reference =$request->reference;
        $research->category =$request->category;
        $research->author =$request->author;
        $research->user_id = Auth::user()->id;

        $research->save();
        return back();

    }





    public function addCatTag(Request $request){

        $ct =new CatTag();
        $ct ->category =$request->category;
        $ct ->tag =$request->tag;
        $ct->save();
        return back();

    }
    public function CatTag(){

        $ct = CatTag::all();

        return view('/admin/addCatTag', ['ct'=>$ct]);

    }

}
