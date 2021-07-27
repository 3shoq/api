<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Resources\commentResource;
use App\Models\User;
use App\Http\Controllers\UserController;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;




class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
            'post_id' => 'required',
            'name_id' => 'required',
            
        ]);
        $comment = new comment();
        $comment -> content = $request ->get('content');
        $comment -> datetime = Carbon::now()->format('Y-m-d H:i:s');
        $comment -> name_id = $request ->get('name_id');
        $comment -> post_id = $id;
        $comment -> user_id = $request->user()->id;
        $comment -> save();

        return  new commentResource( $comment );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(comment $comment)
    {
        //
    }
}
