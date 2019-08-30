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

      if (isset($_POST['login_form'])) {
        if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
          $username = addslashes($_POST['username']);
        }
        $pass = addslashes($_POST['pass']);
        $users = new usersDB();
        $data_set['return'] = $users->users_login($username, $pass);
      }

      if(isset($_POST['newUserDone'])){
        if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
          $username = addslashes($_POST['username']);
        }
          $name = addslashes(htmlspecialchars($_POST['name']));
          $pass = addslashes(password_hash($_POST['pass'], PASSWORD_BCRYPT));
          $age = addslashes(htmlspecialchars($_POST['age']));
          $flag = "outside";
          $users = new usersDB();
          $users->addUser($name, $username, $pass, $age, $flag);
      }

      if (isset($_POST['newPass'])) {
        if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
          $id = addslashes($_POST['username']);
        }
        $pass = addslashes(password_hash($_POST['pass'], PASSWORD_BCRYPT));
        $flag = "outside";
        $users = new usersDB();
        $data_set['return'] = $users->passEdit($pass, $id, $flag);
      }

      $this->loadPage('login', $data_set);
    }

  }

?>
