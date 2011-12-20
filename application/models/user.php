<?php

class User extends Eloquent
{

  public static $timestamps = true;
  public static $per_page = 5;

  public function posts()
  {
    return $this->has_many('Post');
  }

  // Perhaps make this a role model later
  // constants for now

  const PLAIN_USER = 1;
  const EDITOR     = 2;
  const ADMIN      = 4;

  public static $roles = array(
    self::PLAIN_USER => 'Plain User',
    self::EDITOR     => 'Editor',
    self::ADMIN      => 'Administrator'
  );

  private $errors = array();

  public function errors()
  {
    return $this->errors;
  }

  public function save()
  {
    parent::save();
  }

  public function is_valid_new_user()
  {
    $validator = Validator::make($this->attritbutes, array(
      'username' => array('required', 'alpha_num', 'unique:users'),
      'email'    => array('required', 'email', 'unique:users'),
      'password' => array('required', 'confirmed'),
    ));
    if ($validator->valid())
    {
      $this->errors = array();
      $this->password = Hash::make($this->password);
      unset($this->attributes['password_confirmation']);
      return true;
    }
    else
    {
      $this->errors = $validator->errors->all();
      return false;
    }
  }

  public function is_valid()
  {
    $validator = Validator::make($this->dirty, array(
      'username' => array('alpha_num', 'unique:users'),
      'email'    => array('email', 'unique:users'),
      'roles'    => array('required'),
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

  public function has_role($role)
  {
    return ($this->roles & $role) === $role;
  }

  public function is_editor()
  {
    return $this->has_role(self::EDITOR);
  }

  public function is_admin()
  {
    return $this->has_role(self::ADMIN);
  }

}
