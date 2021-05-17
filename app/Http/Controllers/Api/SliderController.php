<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Http\Resources\SliderResource;
use App\Http\Requests\SliderUpdateRequest;

class SliderController extends Controller
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
            $sliders=Slider::where('title', 'like',"%{$searched}%")
           ->latest()->paginate(2);
            
        }else{
            $sliders=Slider::latest()->paginate(2);

        }
        return SliderResource::collection($sliders);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $input= $request->all();

       

       if($request->image) {

         $fileName=$request->file('image')->store('sliders','public');

        $input['image'] = $fileName;
       }
       $slider=Slider::create($input);
        

        return new SliderResource($slider);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return new SliderResource($slider);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sliderUpdate(SliderUpdateRequest $request, $id)
    {

         $slider=Slider::find($id);
      /*   dd($service); */
         $input= $request->all();

       if($request->hasFile('image')) {
           if($request->image==$slider->image){
               $input['image']=$slider->image;
           }else{
             $fileName=$request->file('image')->store('slider','public');

            $input['image'] =$fileName;
            
            @unlink('storage/'.$slider->image);
           }
       } else {

            $input['image']=$slider->image;

       }
       $slider->update([
           'title'=>$request->title,
           'image'=>$input['image'],
       ]);
      /*  dd($service); */

          return new SliderResource($slider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    { 
        $delete=$slider->delete();
        if($delete){
           @unlink('storage/'.$slider->image); 
           return response(['message'=>'Deleted successfully!']);
        }
    }
}