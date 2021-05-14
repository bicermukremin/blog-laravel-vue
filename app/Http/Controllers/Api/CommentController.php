<?php

namespace App\Http\Controllers\Api;

use App\Models\About;
use App\Models\Email;
use App\Models\Comment;
use App\Mail\CommentMailler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Notifications\BlogNotification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CommentResource::collection(Comment::latest()->paginate(4));
    }

    
    public function makeComment(Request $request)
    {
         $input=$request->all();
        
        $about=About::where('active',1)->first();
 
        $input['mission']=$about->mission;
    
        $input['type']='contact';
        $input['content']=$request->description;
        $input['konu']='Yorum';
        Email::create($input);
        $comment=Comment::create([
            'user_id'=>$request->user_id,
            'blog_id'=>$request->blog_id,
            'description'=>$request->description,
            ]);
            Mail::to($input['email'])->cc('bicermukremin86@gmail.com')->queue(new CommentMailler($input));
           $comment->blog->author->notify(new BlogNotification($comment));
        $comments=Comment::where('blog_id',$comment->blog_id)->with('user.profile')->with('replies.replyUser.profile')->with('replies.replyReplies.replyReplyUser.profile')->get();
        return $comments;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
          
              $input= $request->all();
      
              $comment=Comment::create($input);
              
              return new CommentResource($comment);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment=Comment::findOrFail($id);
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
    {
        /* dd($request->all()); */
         $comment=Comment::findOrFail($id);
         $input= $request->all();

            $comment->update($input);
        
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
       $delete=$comment->delete();
       
       if($delete){
          
           return response(['message'=>'Deleted successfully!']);
        }
    }
}
