<?php

class Category extends Eloquent
{

  public static $timestamps = true;

  private $errors = array();

  public function posts()
  {
    return $this->has_many('Post');
  }

  public function errors()
  {
    return $this->errors;
  }

  public function is_valid()
  {
    $validator = Validator::make($this->attributes, array(
      'name' => array('required', 'unique:categories'),
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
