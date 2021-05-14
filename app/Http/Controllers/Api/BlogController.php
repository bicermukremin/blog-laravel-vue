<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Requests\BlogUpdateRequest;
use App\Http\Resources\SingleBlogResource;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset( $_GET['search']) && $_GET['search']!='' ){
            $searched= $_GET['search'];
            $blogs=Blog::where('title', 'like',"%{$searched}%")
            ->orWhere('description', 'like',"%{$searched}%")
            ->with('comments')->with('categories')->with('author')->latest()->paginate(4);
            
        }else{
            $blogs=Blog::with('comments')->with('categories')->with('author')
            ->latest()->paginate(4);
            
        }
   
        return $blogs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
         /* dd($request->all()); */
        $input= $request->all();

       
        $input['slug']=Str::slug($request->title);
       if($request->image) {

         $fileName=$request->file('image')->store('photos','public');

        $input['image'] = $fileName;
       }
       $blog=Blog::create($input);
       $categories=explode(',',$request->categories);
       $attachCategories=array();
       
       for ($i=0; $i < count($categories); $i++) { 
           array_push($attachCategories, intval($categories[$i]));
       }
       
       $blog->categories()->attach($attachCategories);
       $blogAdded=Blog::where('id',$blog->id)->with(['categories','comments'])->firstOrFail();
        
        return new BlogResource($blogAdded);
    }

  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return new SingleBlogResource($blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function blogUpdate(BlogUpdateRequest $request, $id)
    {
        $blog=Blog::find($id);
      /*   dd($blog); */
        $input= $request->all();

        $input['slug']=Str::slug($request->title);

       if($request->hasFile('image')) {
           
        if($request->image==$blog->image){
               $input['image']=$blog->image;
           }else{
             $fileName=$request->file('image')->store('photos','public');

            $input['image'] =$fileName;
            
            @unlink('storage/'.$blog->image);
           }

       } else {

            $input['image']=$blog->image;

       }
       
       $blog->update([
           'title'=>$request->title,
           'description'=>$request->description,
           'author_description'=>$request->author_description,
           'image'=>$input['image'],
           'slug'=>$input['slug'],
       ]);
       
       $categories=explode(',',$request->categories);
       $attachCategories=array();
       
       for ($i=0; $i < count($categories); $i++) { 
           array_push($attachCategories, intval($categories[$i]));
       }
       
       $blog->categories()->sync($attachCategories);
       $blogUpdated=Blog::where('id',$blog->id)->with(['categories','comments'])->firstOrFail();
        
        return new BlogResource($blogUpdated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $delete=$blog->delete();
        $blog->categories()->detach();
        if($delete){
           @unlink('storage/'.$blog->image); 
           return response(['message'=>'Deleted successfully!']);
        }
    }
}
