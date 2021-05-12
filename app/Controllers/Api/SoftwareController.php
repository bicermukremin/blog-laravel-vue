<?php

namespace App\Http\Controllers\Api;

use App\Models\Software;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SoftwareRequest;
use App\Http\Resources\SoftFrontResource;
use App\Http\Resources\SoftwareResource;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $software=Software::where('id',1)->firstOrFail();
        
        return new SoftwareResource($software);
    }


    public function showSoftware()
    {
        $software=Software::where('id',1)->firstOrFail();
        $software['images']=json_decode($software->images);
        
        return new SoftFrontResource($software);
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
    public function store(Request $request)
    {
        
        
         $input= $request->all();
         $software=Software::find(1);
        
         $files = $request->file('images');
         if(is_array(json_decode($software->images)) && empty($software->images)){

             if(count(json_decode($software->images))==6 && $files){
                 return response()->json(['message' =>'Resim kaydetmek için önce silmeniz gerekir.',421]);
             }
              if((count(json_decode($software->images))+count($files))>6){
                 $count=6-count($software->images);
                 return response()
                 ->json(['message'=>"Toplamda kayıtlı resim sayısı 6 olmalıdır. Lütfen $count adet resim seçin ya da öncekileri silin. "],400);
             }
         }
          $input['images']=$this->saveNewImage($files,$input);
        
          if($software->images!="" && is_array(json_decode($software->images))){
             
             $images=json_decode($software->images);
             if(!is_array($images)){
                    $images = [$images];
                }

            $input['images']=array_merge($images,$input['images']);
          
         }

           /*  dd($input['images']); */
            
           
            $software->update([
                'images'=>json_encode($input['images'])
            ]);

            $software['images']=json_decode($software->images);
            
        return new SoftwareResource($software);
    }

    protected function saveNewImage($files,$input){
            
            if($files) {
          
            /* Multiple file upload */
            if(!is_array($files)){
                  $files = [$files];
              }

              //loop through the array 
              for($i=0; $i<count($files); $i++){
                  $file = $files[$i];
                  $fileName=$file->store('software','public');
                  $input['images'][$i]=$fileName;
              }
          
              
          }
                
       return $input['images'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function show(Software $software)
    {
        return new SoftwareResource($software);
    }


    public function resmiSil(Request $request)
    {
        $software=Software::find(1);
        
      
        $images=json_decode($software->images);
        
       
            if(!is_array($images)){
                    $images = [$images];
        }
        
        $imageName=$images[$request->index];
  
        array_splice($images, $request->index, 1);

        
        $images=json_encode($images);
        $delete=$software->update([
            'images' => $images
        ]);
        if($delete){
            @unlink('storage/'.$imageName);
            return true;
        }else{
            return response()->json(['message' =>'Silme İşlemi Başarısız',400]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function edit(Software $software)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function softwareUpdate(SoftwareRequest $request, $id)
    {
       $software=Software::find($id);
      /*   dd($software); */
         $input= $request->all();
        $input['slug']=Str::slug($request->title);
       if($request->hasFile('image')) {
           if($request->image==$software->image){
               $input['image']=$software->image;
           }else{
             $fileName=$request->file('image')->store('photos','public');

            $input['image'] =$fileName;
            
            @unlink('storage/'.$software->image);
           }

            

       } else {

            $input['image']=$software->image;

       }
       $software->update([
           'title'=>$request->title,
           'content'=>$request->content,
           'image'=>$input['image'],
           'slug'=>$input['slug'],
       ]);
      /*  dd($software); */

          return new SoftwareResource($software);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function destroy(Software $software)
    {
        $delete=$software->delete();
        if($delete){
           @unlink('storage/'.$software->image); 
           return response(['message'=>'Deleted successfully!']);
        }
    }
}