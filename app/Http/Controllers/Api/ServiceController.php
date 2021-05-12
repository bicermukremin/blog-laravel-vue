<?php

namespace App\Http\Controllers\Api;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\ServiceUpdateRequest;
use Intervention\Image\Facades\Image;
use App\Http\Resources\ServiceResource;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
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
            $services=Service::where('title', 'like',"%{$searched}%")
            ->orWhere('content', 'like',"%{$searched}%")->latest()->paginate(4);
            
        }elseif(isset( $_GET['service']) && $_GET['service']!='' ){
            
            $service=Service::find($_GET['service']);
            return new ServiceResource($service);
        }else{
            
            $services=Service::latest()->paginate(4);

        }
       
        return ServiceResource::collection($services);
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
    public function store(ServiceRequest $request)
    {
       /*   dd($request->all()); */
        $input= $request->all();
        
       $input['slug']=Str::slug($request->title);
        
       if($request->images) {
           $images=$request->images;
           for ($i=0; $i < count($images); $i++) { 
              $image=$images[$i];
              $fileName[]=$image->store('service','public');
           }


        $input['images'] = json_encode($fileName);
       }
       
        $service=Service::create($input);
  
        return new ServiceResource($service);
    }

  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function serviceUpdate(ServiceUpdateRequest $request, $id)
    {
       $service=Service::find($id);
      /*   dd($service); */
        $input= $request->all();
        $input['slug']=Str::slug($request->title);
       if($request->file('images')) {
          
            $images=$request->file('images');
           
            for ($i=0; $i < count($images); $i++) { 
            $image=$images[$i];
            $fileName[]=$image->store('service','public');
           }
           $input['images'] =json_encode(array_merge(json_decode($service->images),$fileName));
         
           

           
       } else {

            $input['images']=$service->images;

       }
      
       $service->update([
           'title'=>$request->title,
           'items'=>$request->items,
           'content'=>$request->content,
           'images'=>$input['images'],
           'slug'=>$input['slug'],
       ]);
      /*  dd($service); */
        
          return new ServiceResource($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $delete=$service->delete();
        if($delete){
           @unlink('storage/'.$service->image); 
           return response(['message'=>'Deleted successfully!']);
        }
    }



    public function serviceResmiSil(Request $request,$id)
    {
         $service=Service::find($id);
        
        if(isset($service->images) && is_array(json_decode($service->images))){

            $images=json_decode($service->images);
        }
        
            if(!is_array($images)){
                    $images = [$images];
        }
        
        $imageName=$images[$request->index];
  
        array_splice($images, $request->index, 1);

        
        $images=json_encode($images);
        $delete=$service->update([
            'images' => $images
        ]);
        /* $about['images']=json_decode($about->images); */
        if($delete){
            @unlink('storage/'.$imageName);
            return new ServiceResource($service);
        }else{
            return response()->json(['message' =>'Silme İşlemi Başarısız'],400);
        }
    }
}