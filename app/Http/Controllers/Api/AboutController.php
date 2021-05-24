<?php

namespace App\Http\Controllers\Api;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;

class AboutController extends Controller
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
            $abouts=About::where('title', 'like',"%{$searched}%")
            ->orWhere('description', 'like',"%{$searched}%")->latest()->paginate(4);
            
        }else{ 
            $abouts=About::latest()->paginate(4);
        }
        return AboutResource::collection($abouts);
    }
    public function showFrontend()
    {
        
        $about=About::where('active',1)->firstOrFail();
      
        $about['images']=json_decode($about->images);
        $about['history_items']=json_decode($about->history_items);
        return new AboutResource($about);
    }


    
    public function store(Request $request)
    {    
          $input= $request->all();
        if($request->edit=='true'){
           
            $about=About::find($request->id);
            $images=json_decode($about->images);
             if(!is_array($images)){
                $images = [$images];
            }
            
           
            if($request->file('images')) {

            
            $files = $request->file('images');
     
            $input['images']=$this->saveImages($files,$images);
            $input['images']=array_merge($images,$input['images']);
            
             
            }else{
                $input['images']=$images;
            }
             $about->update([
           'images'=>json_encode($input['images']),
           'title'=>$request->title,
           'description'=>$request->description,
           'mission'=>$request->mission,
           'vision'=>$request->vision,
           'history_content'=>$request->history_content,
           'history_items'=>$request->history_items,
       ]);
               
                return new AboutResource($about);
        }else{
            
            if($request->file('images')) {
            /* Multiple file upload */
            $files = $request->file('images');
             $input['images']=$this->saveImages($files);    
            }
   
         $about=About::create([
           'images'=>json_encode($input['images']),
           'title'=>$request->title,
           'description'=>$request->description,
           'mission'=>$request->mission,
           'vision'=>$request->vision,
           'history_content'=>$request->history_content,
           'history_items'=>$request->history_items,
       ]);
        return new AboutResource($about);
        }
        
    }

    public function saveImages($files,$images=[]){
        if(!is_array($files)){
                $files = [$files];
            }
                 if((count($images)+count($files))>4){
                $count=4-count($images);
                return response()
                ->json(['message'=>"Toplamda kayıtlı resim sayısı 4 olmalıdır. Lütfen $count adet resim seçin ya da öncekileri silin. "],400);
            }
            for($i=0; $i<count($files); $i++){
                $file = $files[$i];
                $fileName=$file->store('about','public');
                $input['images'][$i]=$fileName;
            }
            
            return $input['images'];
    }


    
      public function resmiSil(Request $request,$id)
    {
        $about=About::find($id);
        
        if(isset($about->images) && is_array(json_decode($about->images))){

            $images=json_decode($about->images);
        }
        
            if(!is_array($images)){
                    $images = [$images];
        }
        
        $imageName=$images[$request->index];
  
        array_splice($images, $request->index, 1);

        
        $images=json_encode($images);
        $delete=$about->update([
            'images' => $images
        ]);
        /* $about['images']=json_decode($about->images); */
        if($delete){
            @unlink('storage/'.$imageName);
            return new AboutResource($about);
        }else{
            return response()->json(['message' =>'Silme İşlemi Başarısız'],400);
        }

    }


    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $about=About::find($id);
        if(isset($about->images) && is_array(json_decode($about->images))){

            foreach(json_decode($about->images) as $image){
    
                @unlink('storage/'.$image); 
            }
        }
        $delete=$about->delete();
        if($delete){
            
           return response(['message'=>'Deleted successfully!']);
        }
    }



    public function makeActive($id)
    {   
        $about=About::find($id);
       if($about->active=='1'){
            $update=$about->update([
                'active'=>'0'
            ]);
        }else{
            
          
            if(count(About::where('active',1)->get())>0){
                    $active=About::where('active',1)->firstOrFail();
                    $activeId=$active->id;
                    
                    $active->update([
                       'active'=>'0'
                   ]);
                }
           $update=$about->update([
               'active'=>'1'
           ]);
          
       }
        if($update){
             if(isset($activeId)){
                 $abouts=collect([$about,About::where('id',$activeId)->firstOrFail()]);
                 return AboutResource::collection($abouts);
                }else{
                      return new AboutResource($about);
                } 
        }else{
            return response()->json(['message'=>'Something went wrong!'],400);
        }
    }
}
