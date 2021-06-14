<?php

class Auth {

  public static function login($id) {
    session_regenerate_id();
    $_SESSION['user_id'] = $id;
    $_SESSION['last_login'] = time();
  
    return true;
  }
  
  public static function logout() {
    unset($_SESSION['user_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['user']);
    session_destroy();
  
    return true;
  }
  
  public static function is_login() {
    return isset($_SESSION['user_id']);
  }
  
  public static function require_login() {
    if(!Auth::is_login()) {
      return true;
    }
  }
  
}
