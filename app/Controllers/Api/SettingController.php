<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Resources\SettingResource;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
            $setting=Setting::where('id',1)->firstOrFail();
       
        return new SettingResource($setting);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
            $input=$request->all();
            
            $setting=Setting::where('id',$request->id)->firstOrFail();
       
            if($request->file('logo1')){
                $fileName=$request->file('logo1')->store('settings','public');
                  $input['logo1']=$fileName;
            }
            if($request->file('logo2')){
                $fileName=$request->file('logo2')->store('settings','public');
                  $input['logo2']=$fileName;
            }
            $setting->update($input);

            $setting=Setting::where('id',$request->id)->firstOrFail();
            
        return new SettingResource($setting);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}