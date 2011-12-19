<?php

return array(

//----------------- Posts ----------------------
	'GET /, GET /posts' => array('name' => 'home', 'do' => function()
	{
	  $posts = Post::with('user', 'category')->paginate();
		return View::make('layouts.default')->partial('content', 'posts.index', array(
		  'posts' => $posts,
		));
	}),
	
	'GET /posts/(\d+)' => array('name' => 'show_post', 'do' => function($id)
	{
	  Asset::add('post_show', 'js/posts/show.js');
	  $post = Post::with('user', 'comments', 'category')->find($id);
	  return View::make('layouts.default')->partial('content', 'posts.show', array(
	    'post' => $post,
	  ));
	}),
	
	'GET /posts/new' => array('name' => 'new_post', 'before' => 'auth, editor', 'do' => function()
	{
	  $post = new Post;
	  return View::make('layouts.default')->partial('content', 'posts.new', array(
	    'post'       => $post,
	    'categories' => Category::all(),
	  ));
	}),
	
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
	
//----------------- Sessions -------------------
  'GET /session/new' => array('name' => 'login', 'do' => function()
  {
    return View::make('layouts.default')->partial('content', 'session.new', array(
      'error_message' => false,
    ));
  }),

  'POST /session' => array('name' => 'create_session', 'do' => function()
  {
    $validator = Validator::make($_POST, array(
      'username' => array('required'),
      'password' => array('required')
    ));

    if ($validator->valid() and Auth::login($_POST['username'], $_POST['password']))
    {
      return Redirect::to_home()->with('success', 'Login successful');
    }
    else
    {
      return View::make('layouts.default')->partial('content', 'session.new', array(
        'error_message' => 'Wrong username and password',
      ));  
    }
  }),

  'GET /session/destroy' => array('name' => 'logout', 'do' => function()
  {
    Auth::logout();
    return Redirect::to_home()->with('notice', 'Logout successful');  
  }),
//----------------- Users ----------------------
  'GET /users' => array('name' => 'users', 'before' => 'auth, admin', 'do' => function()
  {
    $users = User::paginate();
    return View::make('layouts.default')->partial('content', 'users/index', array(
      'users' => $users,
    ));
  }),

  'GET /users/(\d+)' => array('name' => 'user', 'before' => 'auth, admin', 'do' => function($id)
  {
    $user = User::find($id);
    if (! $user) return Response::error('404');

    return 'Under construction';
  }),

  'GET /users/new' => array('name' => 'register', 'do' => function()
  {
    $user = new User;
    return View::make('layouts.default')->partial('content', 'users.new', array(
      'user' => $user,
    ));
  }),

  'POST /users' => array('name' => 'create_user', 'do' => function()
  {
    $user = new User;
    $user->fill(array(
      'username'              => Input::get('username'), 
      'email'                 => Input::get('email'),
      'password'              => Input::get('password'),
      'password_confirmation' => Input::get('password_confirmation')
    ));
    if ($user->is_valid_new_user())
    {
      $user->save();
      return Redirect::to_home()->with('success', 'Registration successful');
    }
    else 
    {
      return View::make('layouts.default')->partial('content', 'users.new', array(
        'user' => $user,
      ));
    }
  }),

  'GET /users/(\d+)/edit' => array('name' => 'edit_user', 'before' => 'auth, admin', 'do' => function($id)
  {
    $user = User::find($id);
    return View::make('layouts.default')->partial('content', 'users.edit', array(
      'user' => $user,
    ));
  }),

  'PUT /users/(\d+)' => array('name' => 'update_user', 'before' => 'auth, admin, csrf', 'do' => function($id)
  {
    $user = User::find($id);
    $user->fill(array(
      'username' => Input::get('username'),
      'email'    => Input::get('email'),
      'roles'    => array_sum(Input::get('roles')),
    ));
    if ($user->is_valid())
    {
      $user->save();
      return Redirect::to_users()->with('success', 'User updated successfully');
    }
    else
    {
      return View::make('layouts.default')->partial('content', 'users/edit', array(
        'user' => $user,
      ));
    }
  }),

  'GET /users/(\d+)/destroy' => array('name' => 'destroy_user', 'before' => 'auth, admin', 'do' => function($id)
  {
    User::find($id)->delete();
    return Redirect::to_users()->with('notice', 'User destroyed successfully');
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
