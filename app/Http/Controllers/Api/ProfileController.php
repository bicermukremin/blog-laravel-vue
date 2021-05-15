<?php

namespace App\Http\Controllers\Api;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\User;

class ProfileController extends Controller
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
            $profiles=Profile::where('about', 'like',"%{$searched}%")
            ->latest()->paginate(4);
            
        }else{
            
            $profiles=Profile::latest()->paginate(4);

        }
       
        return ProfileResource::collection($profiles);
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
    public function store(ProfileRequest $request)
    {
         
        $input= $request->all();
     
        $user=User::find($input['user_id']);
       
        
        if($request->avatar) {

         $fileName=$request->file('avatar')->store('avatars','public');

        $input['avatar'] = $fileName;
        $user->profile->avatar=$input['avatar'];
       }
       $user->profile->user_id=$input['user_id'];
       $user->profile->facebook=$input['facebook'];
       $user->profile->instagram=$input['instagram'];
       $user->profile->linkedIn=$input['linkedIn'];
       $user->profile->web=$input['web'];
       $user->profile->twitter=$input['twitter'];
       $user->profile->youtube=$input['youtube'];
       $user->profile->save();
       $user->name=$input['name'];
       $user->email=$input['email'];
       $user->save();
      
  
        return $user->profile;
    }

  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return new ProfileResource($profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function serviceUpdate(ProfileRequest $request, $id)
    {
       $profile=Profile::find($id);
      /*   dd($profile); */
        $input= $request->all();
            if($request->hasFile('avatar')) {
           
        if($request->avatar==$profile->avatar){
               $input['avatar']=$profile->avatar;
           }else{
             $fileName=$request->file('avatar')->store('avatars','public');

            $input['avatar'] =$fileName;
            
            @unlink('storage/'.$profile->avatar);
           }

       } else {

            $input['avatar']=$profile->avatar;

       }
      
       $profile->update([
           'about'=>$request->about,
           'facebook'=>$request->facebook,
           'twitter'=>$request->twitter,
           'instagram'=>$request->instagram,
           'youtube'=>$request->youtube,
           'linkedIn'=>$request->linkedIn,
           'avatar'=>$input['avatar'],
           'user_id'=>$request->user_id,
         
       ]);
      /*  dd($profile); */
        
          return new ProfileResource($profile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $delete=$profile->delete();
        if($delete){
           @unlink('storage/'.$profile->avatar); 
           return response(['message'=>'Deleted successfully!']);
        }
    }



    public function serviceResmiSil(Request $request,$id)
    {
         $profile=Profile::find($id);
        
        if(isset($profile->images) && is_array(json_decode($profile->images))){

            $images=json_decode($profile->images);
        }
        
            if(!is_array($images)){
                    $images = [$images];
        }
        
        $imageName=$images[$request->index];
  
        array_splice($images, $request->index, 1);

        
        $images=json_encode($images);
        $delete=$profile->update([
            'images' => $images
        ]);
        /* $about['images']=json_decode($about->images); */
        if($delete){
            @unlink('storage/'.$imageName);
            return new ProfileResource($profile);
        }else{
            return response()->json(['message' =>'Silme İşlemi Başarısız'],400);
        }
    }
}