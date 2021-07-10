<?php
  
  // Setando sessão principal do sistema para uso externo
  global $core_session_ex;
  if (isset($_SESSION['prymarya2_session_log'])) {
    $core_session_ex = $_SESSION['prymarya2_session_log'];
  }

  global $config;
  $config = array();
  
  if (!file_exists('local.config.php')) {
    
    ini_set("display_errors", "Off");
    define("BASEURL", "SITENOAR");
    $config['dbname'] = 'BANCONOAR';
    $config['host']   = 'CAMINHODOBANCONOAR';
    $config['dbuser'] = 'USUARIONOAR';
    $config['dbpass'] = 'SENHANOAR';
    echo "config local existe sim";

  } else {
    require 'local.config.php';
  }

 ?>
