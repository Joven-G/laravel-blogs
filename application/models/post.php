<?php

class Post extends Eloquent
{

    public static $timestamps = true;
    public static $per_page = 5;

    public function user()
    {
      return $this->belongs_to('User');
    }

    public function comments()
    {
      return $this->has_many('Comment');
    }

    public function category()
    {
      return $this->belongs_to('Category');
    }

    private $errors = array();

    public function errors()
    {
      return $this->errors;
    }

    public function is_valid()
    {
      $validator = Validator::make($this->attributes, array(
        'title'       => array('required'),
        'content'     => array('required'),
        'user_id'     => array('required'),
        'category_id' => array('required'),
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
