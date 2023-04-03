<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//bring in the model
use App\Post;

use DB; //bring in DB library to allow to write sql queries

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          //query with parameters using eloquent
            $posts = Post::orderBy('title','desc')->take(2)->get(); //example of oder by and limit; take()
            // $posts = Post::orderBy('title','desc')->get() ; //example of oder by
            //$posts = Post::where('title','car for sale')->get();   //example with where clause
        // $posts = Post::all(); // get all post and pass to variable

        //example of sql query
        //$posts = DB::select('SELECT * FROM posts');


        //display all existing posts
        //load the view  from folder call posts and file called applications.blade.php
           //pass variable $post to view through with
        $posts = Post::orderBy('created_at','desc')->paginate(2);  // paginate
        return view('posts.index')->with('posts', $posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create data instance of post
        return view('posts.create'); // show form that allows user to post

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate given information and store in database
        $this->validate($request,[
              'title' =>'required',
              'description' =>'required'
        ]);
        //create instance of the model
        $post = new Post;
        $post->title = $request->input('title'); //this request->input('title') gets what is submitted in the form
        $post->description = $request->input('description');

        //get id of the user that posted. this does not come from form it comes from the user's info in the db
           //this will get currently logged in user id and stores in variable

         $post->user_id = auth()->user()->id; // get user id field from db

        //$post->post_author =auth()->user()->firstname;

        $post->save(); //save the info, info is saved in db (all post variables above are saved in this step)

        //redirect
        return redirect('/posts')->with('success','Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //fetch info about specific item from the database
         $post = Post::find($id); // this returns single post which we put in variable NB: Post in this case is the model
          return view('posts.show')->with('post', $post);   //load item specific info in the view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            //fetch info about specific item from the database
            $post = Post::find($id); // this returns single post which we put in variable NB: Post in this case is the model
            return view('posts.edit')->with('post', $post);   //load item specific info in the view
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
       //validate given information and store in database
       $this->validate($request,[
        'title' =>'required',
        'description' =>'required'
         ]);
        //create instance of the model
        $post = Post::find($id);
        $post->title = $request->input('title'); //this request->input('title') gets what is submitted in the form
        $post->description = $request->input('description');
        $post->save(); //save the info, info is saved in db

        //redirect
        return redirect('/posts')->with('success','Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post= Post::find($id);  //find post that is being deleted via its id
      $post->delete();
              //redirect
              return redirect('/posts')->with('success','Post removed');
    }
}
