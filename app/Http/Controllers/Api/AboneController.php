<?php

namespace App\Http\Controllers\Api;

use App\Models\Abone;
use App\Models\About;
use App\Models\Email;
use App\Mail\AboneMailer;
use Illuminate\Http\Request;
use App\Http\Requests\AboneRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\AboneResource;

class AboneController extends Controller
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
            $abones=Abone::where('email', 'like',"%{$searched}%")
           ->latest()->paginate(50);
            
        }else{
            $abones=Abone::latest()->paginate(50);

        }
        return AboneResource::collection($abones);
    }



    public function makeAbone(AboneRequest $request)
    {
        
        $input = $request->all();
        $create=Abone::create($input);
        if(!$create){
            return response()->json(['message'=>'Abone işlemi başarısız'],400);
        }
        $about=About::where('active',1)->first();
 
        $input['mission']=$about->mission;
          Mail::to($input['email'])->cc('bicermukremin86@gmail.com')->queue(new AboneMailer($input));
          $input['type']='abone';
          $input['konu']='Abone';
          Email::create($input);
        return response()->json(['message'=>'Abone işlemi başarılı'],201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(AboneRequest $request)
    {
        $input= $request->all();

       $abone=Abone::create($input);
        

        return new AboneResource($abone);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function aboneUpdate(Request $request, $id)
    {

         $abone=Abone::find($id);
        
         $input= $request->all();
          
       $abone->update([
           'email'=>$request->email,
       ]);
      /*  dd($service); */

          return new AboneResource($abone);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Abone $abone)
    { 
        $delete=$abone->delete();
        if($delete){
           
           return response(['message'=>'Deleted successfully!']);
        }
    }
}
