<?php

namespace App\Http\Controllers\Api;

use App\Models\About;
use App\Models\Email;
use App\Models\Comment;
use App\Mail\CommentMailler;
use Illuminate\Http\Request;
use App\Mail\MessageSendMailer;
use App\Http\Requests\MailRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\MailResource;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\CommentResource;
use App\Notifications\BlogNotification;

class MailController extends Controller
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
            $mails=Email::where('email', 'like',"%{$searched}%")
           ->latest()->paginate(2);
            
        }else{
            $mails=Email::latest()->paginate(2);

        }
        return MailResource::collection($mails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MailRequest $request)
    {
        $input= $request->all();

       $mail=Email::create($input);
        

        return new MailResource($mail);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendMail(MailRequest $request)
    {
         $input=$request->all();
        $about=About::where('active',1)->first();
 
        $input['mission']=$about->mission;
    
        Mail::to($input['email'])->cc('bicermukremin86@gmail.com')->queue(new MessageSendMailer($input));
        $input['type']='contact';
        $message=Email::create($input);
       
        return new MailResource($message);
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
            'user_id'=>auth()->user()->id,
            'blog_id'=>$request->blog_id,
            'description'=>$request->description,
            ]);
            Mail::to($input['email'])->cc('bicermukremin86@gmail.com')->queue(new CommentMailler($input));
           $comment->blog->author->notify(new BlogNotification($comment));
        $comments=Comment::where('blog_id',$comment->blog_id)->get();
        return CommentResource::collection($comments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function mailUpdate(Request $request, $id)
    {

         $mail=Email::find($id);
        
         $input= $request->all();
          
       $mail->update($input);
      /*  dd($service); */

          return new MailResource($mail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $mail)
    { 
        $delete=$mail->delete();
        if($delete){
           
           return response(['message'=>'Deleted successfully!']);
        }
    }
}
