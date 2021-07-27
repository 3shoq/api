<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PostsResource;
use App\Models\post;
use App\Http\Resources\PostResource;
use App\Models\comment;
use App\Http\Resources\UserCommentsResource;
use App\Models\User;
use App\Http\Controllers\UserController;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;




class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::with(['comments' , 'user' , 'category']) ->Paginate();
        return new PostsResource($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
         $request -> validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            
            

         ]);

       

        $user = $request->user();

        //user()->user_id = $request->get('user_id');

        $post = new Post();

        $post->title = $request ->get ('title');
        $post->content =$request ->get ('content');
         

        if (intval($request->get('category_id') ) !=0 ){
            $post->category_id = intval( $request-> get('category_id') );
        }
        $post->user_id =$user->id;

        //TODO: imge_feacher
        $post->votes_up =0;
        $post->votes_down =0;


        $post ->date_written = Carbon::now()->format('Y-m-d H:i:s');

        if($request->hasFile('post_imge')){
            $post_imge =$request->file('post_imge');
            $filename = time().$post_imge->getClientOriginalName();
            Storage::disk('imge')->putFileAs(
                $filename,
                $post_imge,
                $filename,
            );
            $post->post_imge= url('/') . '/imges' .$filename;
        }

        $post->save();

        return new postResource($post);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // return new PostResource(post::find($id));
       $post = post::with(['comments' , 'user' , 'category']) ->where ('id' , $id) -> get();
       return new postResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * 
     */
    public function update(Request $request, post $post)
    {
        
        $user = $request->user();
        $post = post::find(id);

        //user()->user_id = $request->get('user_id');

        if ($request->has('title')) {
            # code...
            $post->title = $request ->get ('title');
        }


        if ($request->has('content')) {
            # code...
            $post->content =$request ->get ('content');

        }
        
         if ($request->has('category_id')) {
             # code...
             if (intval($request->get('category_id') ) !=0 ){
                $post->category_id = intval( $request-> get('category_id') );
            }
         }

        

        //TODO: imge_feacher
     

        if($request->hasFile('post_imge')){
            $post_imge =$request->file('post_imge');
            $filename = time().$post_imge->getClientOriginalName();
            Storage::disk('imge')->putFileAs(
                $filename,
                $post_imge,
                $filename,
            );
            $post->post_imge= url('/') . '/imges' .$filename;
        }

        $post->save();

        return new postResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return new PostResource( $post );
    }

    public function comments($id){
        $post = Post::find($id);
        $comments = $post->comments()->paginate();

        return new UserCommentsResource($comments);


    }

    public function allcomments(){
        $comment = \App\Models\comment::All();
        return $comment ;
    }



    public function votes(Request $request , $id){

        $request -> validate([
            'vote' =>'required',
        ]);
        $post = Post::find($id);
        if ($request->get('vote') == 'up') {
            # code...
            $voters_up = json_decode($post ->Voters_up);
            if ($voters_up == null) {
                # code...
                $voters_up =[];
            }

            if (! in_array($request->user()->id , $voters_up)) {
                # code...
                $post->votes_up += 1;
                array_push($voters_up , $request->user()->id);
                $post->voters_up =json_encode($voters_up);
                $post->save();
            }

        }

        if ($request->get('vote') == 'down') {
            # code...
            $voters_down = json_decode($post ->Voters_down);
            if ($voters_down == null) {
                # code...
                $voters_down =[];
            }

            if (! in_array($request->user()->id , $voters_down)) {
                # code...
                $post->votes_down +=1;
                array_push($voters_down , $request->user()->id);
                $post->voters_down =json_encode($voters_down);
                $post->save();
            }


        }


        return new postResource($post);

    }

}
