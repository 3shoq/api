<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use App\Models\post;
use   App\Http\Resources\PostsResource;
use  App\Http\Resources\CategoryResource;
use App\Http\Controllers\CategoryController;




class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Catogory = \App\Models\Category::Paginate();
        return new CategoryResource($Catogory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
    }


     /**
     * 
     *
     *
     */
    public Function posts($id){

        $category = category::find($id);
        $posts =$category->posts()->paginate();
        return new PostsResource($posts);

    }
}
