<?php
  /**
   * CONTROLADOR DA TELA COM FUNÇÕES MODAL DO SISTEMA.
   */
  class modalController extends controller
  {

    public function __construct(){
        parent::__construct();
        $users = new usersDB();
        $users->users_check_session();
        global $user_in;
        $user_in = intval($_SESSION['prymarya2_session_log']);
    }

    public function index(){
      $data_set = array('erro' => '');
      $users = new usersDB();
      $data_set['users'] = $users->getUsers();

      if (isset($_POST['imageUserDone'])) {
        $image = $_FILES['image'];
        $id_usu = $_POST['id_usu'];
        $flag = "modal";
        $users = new usersDB();
        $users->imageUser($image, $id_usu, $flag);
      }

    if (isset($_POST['editUserDone'])) {
      if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
        $username = addslashes($_POST['username']);
      }
      $active = $_POST['active'];
      $name = addslashes(htmlspecialchars($_POST['name']));
      $age = addslashes(htmlspecialchars($_POST['age']));
      $id = $_POST['id'];
      $flag = "modal";
      $users = new usersDB();
      $users->editUser($active, $name, $username, $age, $id, $flag);
    }

    if (isset($_POST['passEditDone'])) {
      $pass = addslashes(password_hash($_POST['pass'], PASSWORD_BCRYPT));
      $id = $_POST['id'];
      $flag = "modal";
      $users = new usersDB();
      $users->passEdit($pass, $id, $flag);
    }

    if (isset($_POST['delUserDone'])) {
      $id = $_POST['id'];
      $users = new usersDB();
      $users->delUser($id);
    }
      $this->loadTemplate('modal', $data_set);
    }

    public function setNewUser(){
      $new_user_name = htmlspecialchars($_POST['new_user_name']);
      if (filter_var($_POST['new_user_email'], FILTER_VALIDATE_EMAIL)) {
        $new_user_email = htmlspecialchars($_POST['new_user_email']);
      }
      $new_user_age = htmlspecialchars($_POST['new_user_age']);
      $new_user_pass = password_hash($_POST['new_user_pass'], PASSWORD_BCRYPT);

      $flag = "modal";
      $users = new usersDB();
      $users->addUser($new_user_name, $new_user_email, $new_user_age, $new_user_pass, $flag);
    }

  }

?>
