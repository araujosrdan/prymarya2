<?php
  /**
   * CONTROLADOR DA TELA DE LOGIN
   */
  class loginController extends controller
  {

    public function __construct(){
        parent::__construct();
        //$users = new usersDB();
        //$users->users_check_session();
    }

    public function index(){
      $data_set = array('return' => '');
      $this->loadPage('login', $data_set);
    }

    public function logIn(){
      if (filter_var($_POST['login_email'], FILTER_VALIDATE_EMAIL)) {
        $login_email = htmlspecialchars($_POST['login_email']);
      }
      $login_pass = urldecode(base64_decode($_POST['login_pass']));
      
      $users = new usersDB();
      $users->logIn($login_email, $login_pass);
    }

    public function setNewUser(){
      $new_user_name = htmlspecialchars($_POST['new_user_name']);
      if (filter_var($_POST['new_user_email'], FILTER_VALIDATE_EMAIL)) {
        $new_user_email = htmlspecialchars($_POST['new_user_email']);
      }
      $new_user_age = htmlspecialchars($_POST['new_user_age']);
      $new_user_pass = password_hash($_POST['new_user_pass'], PASSWORD_BCRYPT);

      $users = new usersDB();
      $users->setNewUser($new_user_name, $new_user_email, $new_user_age, $new_user_pass);
    }

    public function setNewPass(){
      if (filter_var($_POST['newpass_email'], FILTER_VALIDATE_EMAIL)) {
        $newpass_email = htmlspecialchars($_POST['newpass_email']);
      }
      $newpass_pass_get = urldecode(base64_decode($_POST['newpass_pass'])); 
      $newpass_pass = password_hash($newpass_pass_get, PASSWORD_BCRYPT);
      
      $users = new usersDB();
      $users->setNewPass($newpass_email, $newpass_pass);
    }

  }

?>
