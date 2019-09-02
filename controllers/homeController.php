<?php
  /**
   * CONTROLADOR DA TELA HOME DO SISTEMA.
   */
  class homeController extends controller
  {

    public function __construct(){
        parent::__construct();
        $users = new usersDB();
        $users->users_check_session();
        global $user_in;
        $user_in = intval($_SESSION['prymarya2_session_log']);
    }

    public function index(){
      $data_set = array();
      $this->loadTemplate('home', $data_set);
    }

    public function logout(){
      $users = new usersDB();
      $users->logOff();
    }

  }

?>
