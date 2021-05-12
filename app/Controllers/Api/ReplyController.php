<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\ReplyReply;
use Illuminate\Http\Request;
use App\Http\Requests\ReplyRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\ReplyResource;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ReplyResource::collection(Reply::latest()->paginate(4));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReplyRequest $request)
    {
          
              $input= $request->all();
              $reply=Reply::create($input);
              $blog=$reply->comment->blog()->with('categories')->with('comments')->firstOrFail();
             
              return new BlogResource($blog);

    }
    public function replyReply(Request $request)
    {
          
              $input= $request->all();
             
              $replyreply=ReplyReply::create($input);
              $blog=$replyreply->reply->comment->blog()->with('categories')->with('comments')->firstOrFail();
             
              return new BlogResource($blog);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reply=Reply::findOrFail($id);
        return new ReplyResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReplyRequest $request, $id)
    {
        /* dd($request->all()); */
         $reply=Reply::findOrFail($id);
         $input= $request->all();

            $reply->update($input);
        
        return new ReplyResource($reply);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
       $delete=$reply->delete();
       
       if($delete){
          
           return response(['message'=>'Deleted successfully!']);
        }
    }
}