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
      if(isset($_POST['newUserDone'])){
        if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
          $username = addslashes($_POST['username']);
        }
          $name = addslashes(htmlspecialchars($_POST['name']));
          $pass = addslashes(password_hash($_POST['pass'], PASSWORD_BCRYPT));
          $age = addslashes(htmlspecialchars($_POST['age']));
          $flag = "parameter";
          $users = new usersDB();
          $data_set['return'] = $users->addUser($name, $username, $pass, $age, $flag);
      }
      $this->loadTemplate('parameter/new', $data_set);
    }

    public function edit(){
      $data_set = array('return' => '');
      $users = new usersDB();
      $data_set['user_selected'] = $users->getUserSelected($_GET['id']);
      if (isset($_POST['editUserDone'])) {
        if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
          $username = addslashes($_POST['username']);
        }
        $active = $_POST['active'];
        $name = addslashes(htmlspecialchars($_POST['name']));
        $age = addslashes(htmlspecialchars($_POST['age']));
        $id = $_POST['id_usu'];
        $flag = "parameter";
        $users = new usersDB();
        $data_set['return'] = $users->editUser($active, $name, $username, $age, $id, $flag);
      }
      $this->loadTemplate('parameter/edit', $data_set);
    }

    public function image(){
      $data_set = array('return' => '');
      $users = new usersDB();
      $data_set['user_selected'] = $users->getUserSelected($_GET['id']);
      if (isset($_POST['imageUserDone'])) {
        $id_usu = $_POST['id_usu'];
        $image = $_FILES['image'];
        $flag = "parameter";
        $users = new usersDB();
        $data_set['return'] = $users->imageUser($image, $id_usu, $flag);
      }
      $this->loadTemplate('parameter/image', $data_set);
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
