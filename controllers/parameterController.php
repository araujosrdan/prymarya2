<?php
  /**
   * CONTROLADOR DA TELA COM FUNÇÕES POR PARÂMETRO DO SISTEMA.
   */
  class parameterController extends controller
  {

    public function __construct(){
        parent::__construct();
        $users = new usersDB();
        $users->users_check_session();
        global $user_in;
        $user_in = intval($_SESSION['prymarya2_session_log']);
    }

    public function index(){
      $data_set = array('return' => '');
      $users = new usersDB();
      $data_set['users'] = $users->getUsers();

      $this->loadTemplate('parameter/view', $data_set);
    }

    public function new(){
      $data_set = array('return' => '');
      $this->loadTemplate('parameter/new', $data_set);
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

    public function edit(){
      $data_set = array('return' => '');
      $users = new usersDB();
      $data_set['user_selected'] = $users->getUserSelected($_GET['id']);
      $this->loadTemplate('parameter/edit', $data_set);
    }

    public function setEditUser(){
      if (filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
        $user_email = addslashes($_POST['user_email']);
      }
      if (isset($_POST['user_pass']) && !empty($_POST['user_pass'])) {
        $user_pass_get = urldecode(base64_decode($_POST['user_pass'])); 
        $user_pass = password_hash($user_pass_get, PASSWORD_BCRYPT);
      } else {
        $user_pass = '';
      }
      $user_active = $_POST['user_active'];
      $user_name = addslashes(htmlspecialchars($_POST['user_name']));
      $user_age = addslashes(htmlspecialchars($_POST['user_age']));
      $id_usu = $_POST['id_usu'];
      $users = new usersDB();
      $users->setEditUser($user_active, $user_name, $user_email, $user_age, $user_pass, $id_usu);
    }

    public function image(){
      $data_set = array('return' => '');
      $users = new usersDB();
      @$data_set['user_selected'] = $users->getUserSelected($_GET['id']);
      $this->loadTemplate('parameter/image', $data_set);
    }

    public function setUserImg(){
      $image = $_FILES['user_image'];
      $id_usu = $_POST['id_usu'];
      
      $users = new usersDB();
      $users->setUserImg($image, $id_usu);
    }

    public function pass(){
      $data_set = array('return' => '');
      $users = new usersDB();
      $data_set['user_selected'] = $users->getUserSelected($_GET['id']);
      if (isset($_POST['passEditDone'])) {
        $pass = addslashes(password_hash($_POST['pass'], PASSWORD_BCRYPT));
        $id = $_POST['id_usu'];
        $flag = "parameter";
        $users = new usersDB();
        $data_set['return'] = $users->passEdit($pass, $id, $flag);
      }
      $this->loadTemplate('parameter/pass', $data_set);
    }

    public function delete(){
      $data_set = array('return' => '');
      $users = new usersDB();
      $data_set['user_selected'] = $users->getUserSelected($_GET['id']);
      if (isset($_POST['delUserDone'])) {
        $id = $_POST['id'];
        $users = new usersDB();
        $data_set['return'] = $users->delUser($id);
      }
      $this->loadTemplate('parameter/delete', $data_set);
    }

  }

?>
