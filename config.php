<?php
  require 'enviroment.php';

  // Setando sessão principal do sistema para uso externo
  global $core_session_ex;
  if (isset($_SESSION['prymarya2_session_log'])) {
    $core_session_ex = $_SESSION['prymarya2_session_log'];
  }

  global $config;
  $config = array();
  if (ENVIROMENT == 'development') {
    ini_set("display_errors", "On");
    define("BASEURL", "http://localhost/prymarya2/");
    $config['dbname'] = 'prymarya2db';
    $config['host']   = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'root';
  } else {
    ini_set("display_errors", "Off");
    define("BASEURL", "SITENOAR");
    $config['dbname'] = 'BANCONOAR';
    $config['host']   = 'CAMINHODOBANCONOAR';
    $config['dbuser'] = 'USUARIONOAR';
    $config['dbpass'] = 'SENHANOAR';
  }

 ?>
