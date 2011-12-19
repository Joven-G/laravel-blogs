<?php

return array(

//----------------- Posts ----------------------
	'GET /, GET /posts' => function()
	{
	  $posts = Post::with('user', 'category')->paginate();
		return View::make('layouts.default')->partial('content', 'posts.index', array(
		  'posts' => $posts,
		));
	},
	
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
	
//----------------- Comments -------------------

  'POST /comments' => array('name' => 'create_comment', 'before' => 'csrf', 'do' => function() 
  {
    $comment = new Comment;
    $comment->fill(array(
      'username' => Input::get('username'),
      'email'    => Input::get('email'),
      'content'  => Input::get('content'),
      'post_id'  => Input::get('post_id'),
    ));  
    if ($comment->is_valid())
    {
      $comment->save();
      return json_encode(array('status' => 1, 'data' => View::make('comments.show', array('comment' => $comment))->get()));
    }
    else
    {
      return json_encode(array('status' => 0, 'data' => View::make('comments.new', array('comment' => $comment))->get()));
    }
  }),

//----------------- Categories -----------------
  'GET /categories/new' => array('name' => 'new_category', 'before' => 'auth', 'do' => function()
  {
    $category = new Category;
    return View::make('layouts.default')->partial('content', 'categories.new', array(
      'category' => $category,  
    ));
  }),

  'POST /categories' => array('name' => 'create_category', 'before' => 'auth, csrf', 'do' => function()
  {
    $category = new Category;
    $category->fill(array('name' => Input::get('name')));
    if ($category->is_valid())
    {
      $category->save();
      return Redirect::to_home()->with('success', 'Category created successfully');
    }
    else
    {
      return View::make('layouts.default')->partial('content', 'categories.new', array(
        'category' => $category,  
      ));
    }
  }),
);
