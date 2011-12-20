<?php

return array(

//----------------- Posts ----------------------
	'GET /, GET /posts' => function()
	{
	  $posts = Post::with('user', 'category')->paginate();
		return View::make('layouts.default')->nest('content', 'posts.index', array(
		  'posts' => $posts,
		));
	},
	/*
	'GET /posts/(\d+)' => function($id)
	{
	  Asset::add('post_show', 'js/posts/show.js');
	  $post = Post::with('user', 'comments', 'category')->find($id);
	  return View::make('layouts.default')->partial('content', 'posts.show', array(
	    'post' => $post,
	  ));
	},
	
	'GET /posts/new' => function()
	{
	  $post = new Post;
	  return View::make('layouts.default')->partial('content', 'posts.new', array(
	    'post'       => $post,
	    'categories' => Category::all(),
	  ));
	},
	
	'POST /posts' => array('name' => 'create_post', 'before' => 'auth, editor, csrf', 'do' => function()
	{
	  $post = new Post;
	  $post->fill(array(
	    'title'       => Input::get('title'),
	    'content'     => Input::get('content'),
	    'category_id' => Input::get('category_id'),
	    'user_id'     => Auth::user()->id,
	  ));
	  if ($post->is_valid())
	  {
	    $post->save();
	    return Redirect::to_show_post(array('id' => $post->id))->with('success', 'Post created successfully');
	  }
	  else
	  {
	    return View::make('layouts.default')->partial('content', 'posts.new', array(
	      'post'       => $post,
	      'categories' => Category::all(),
	    ));
	  }
	}),
        */
);
