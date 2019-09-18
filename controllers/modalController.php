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

      $this->loadTemplate('modal', $data_set);
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

    public function setEditUser(){
      if (filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
        $user_email = addslashes($_POST['user_email']);
      }
      $user_active = $_POST['user_active'];
      $user_name = addslashes(htmlspecialchars($_POST['user_name']));
      $user_age = addslashes(htmlspecialchars($_POST['user_age']));
      $id_usu = $_POST['id_usu'];
      $users = new usersDB();
      $users->setEditUser($user_active, $user_name, $user_email, $user_age, $id_usu);
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

    public function setUserImg(){
      $image = $_FILES['user_image'];
      $id_usu = $_POST['id_usu'];
      
      $users = new usersDB();
      $users->setUserImg($image, $id_usu);
    }

    public function setDelUser(){
      $id_usu = $_POST['id_usu'];
      $users = new usersDB();
      $users->setDelUser($id_usu);
    }

  }

?>
