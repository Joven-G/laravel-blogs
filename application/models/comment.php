<?php

class Comment extends Eloquent {

  public static $timestamps = true; 

  public function post()
  {
    return $this->belongs_to('Post');
  }

  private $errors = array();

  public function errors()
  {
    return $this->errors;
  }

  public function is_valid()
  {
    $validator = Validator::make($this->attributes, array(
      'username' => array('required'),
      'email'    => array('required', 'email'),
      'content'  => array('required'),
      'post_id'  => array('required'),
    ));

    if ($validator->valid())
    {
      $this->errors = array();
      return true;
    }
    else
    {
      $this->errors = $validator->errors->all();
      return false;
    }
  }

}

