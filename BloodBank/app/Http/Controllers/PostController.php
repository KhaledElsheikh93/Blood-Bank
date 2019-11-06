<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Post::paginate(10);
        return view('posts.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create'  , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title'           => 'required',
            'category_id'     => 'required',
            'content'         => 'required'
        ];

        $message = [
            'title.required'           => 'Post title is required',
            'category_id.required'     => 'please choose category',
            'content.required'         => 'please fill the content'
        ];

        $this->validate($request, $rules, $message);
        $records = Post::create($request->all());
        flash("Your Post has been added")->success();
        return redirect(route('posts.index'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Post::findOrfail($id);
        
        $categories = Category::all();
        return view('posts.edit'  , compact(['model', 'categories']));
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
        $rules = [
            'title'           => 'required',
            'category_id'     => 'required',
            'content'         => 'required'
        ];

        $message = [
            'title.required'           => 'Post title is required',
            'category_id.required'     => 'please choose category',
            'content.required'         => 'please fill the content'
        ];

        $this->validate($request, $rules, $message);
        
        $record = Post::findOrfail($id);
        $record->update($request->all());
        flash('Post Edited')->success();
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Post::findOrfail($id);
        $record->delete();
        flash("Deleted")->success();
        return back();
    }
}
