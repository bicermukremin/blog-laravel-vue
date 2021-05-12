<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ServiceResource;
use App\Http\Requests\ProjectUpdateRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {

        if(isset( $_GET['search']) && $_GET['search']!='' ){
            $searched= $_GET['search'];
            $projects=Project::where('company_name', 'like',"%{$searched}%")
            ->with('service')
            ->latest()->paginate(7);
            return ProjectResource::collection($projects);
            
        }elseif(isset( $_GET['service']) && $_GET['service']!='' ){

            $projects=Service::where('id',$_GET['service'])->with('projects')->latest()->get();
            return ServiceResource::collection($projects);
                
        }else{
            $projects=Project::with('service')->latest()->paginate(7);
           
            return ProjectResource::collection($projects);
        }
       
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
    public function store(ProjectRequest $request)
    {
         /* dd($request->all()); */
        $input= $request->all();

       

       if($request->image) {

         $fileName=$request->file('image')->store('photos','public');

        $input['image'] = $fileName;
       }
       $project=Project::create($input);

       
        
        return new ProjectResource($project);
    }

  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function projectUpdate(ProjectUpdateRequest $request, $id)
    {
       $project=Project::find($id);
      /*   dd($project); */
         $input= $request->all();

       if($request->hasFile('image')) {
           if($request->image==$project->image){
               $input['image']=$project->image;
           }else{
             $fileName=$request->file('image')->store('photos','public');

            $input['image'] =$fileName;
            
            @unlink('storage/'.$project->image);
           }

            

       } else {

            $input['image']=$project->image;

       }
       $project->update([
           'company_name'=>$request->company_name,
           'service_id'=>$request->service_id,
           'image'=>$input['image'],
       ]);
      /*  dd($project); */

          return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $delete=$project->delete();
        if($delete){
           @unlink('storage/'.$project->image); 
           return response(['message'=>'Deleted successfully!']);
        }
    }
}