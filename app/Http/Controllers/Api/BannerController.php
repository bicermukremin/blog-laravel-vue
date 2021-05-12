<?php

namespace App\Http\Controllers\Api;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Http\Resources\BannerResource;

class BannerController extends Controller
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
            $banners=Banner::where('content', 'like',"%{$searched}%")
           ->latest()->paginate(2);
            
        }else{
            $banners=Banner::latest()->paginate(2);

        }
        return BannerResource::collection($banners);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        $input= $request->all();

       

       if($request->file('image')) {

         $fileName=$request->file('image')->store('banners','public');

        $input['image'] = $fileName;
       }
       $banner=Banner::create($input);
        

        return new BannerResource($banner);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return new BannerResource($banner);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bannerUpdate(BannerRequest $request, $id)
    {

         $banner=Banner::find($id);
      /*   dd($service); */
         $input= $request->all();

       if($request->hasFile('image')) {
           if($request->image==$banner->image){
               $input['image']=$banner->image;
           }else{
             $fileName=$request->file('image')->store('banner','public');

            $input['image'] =$fileName;
            
            @unlink('storage/'.$banner->image);
           }
       } else {

            $input['image']=$banner->image;

       }
       $banner->update([
           'title'=>$request->title,
           'image'=>$input['image'],
       ]);
      /*  dd($service); */

          return new BannerResource($banner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    { 
        $delete=$banner->delete();
        if($delete){
           @unlink('storage/'.$banner->image); 
           return response(['message'=>'Deleted successfully!']);
        }
    }
}