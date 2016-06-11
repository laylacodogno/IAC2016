<?php
  if(session_status() == PHP_SESSION_NONE){
    session_start();
  }
  $admin = false;
  if((isset($_SESSION['usuario'])) && (isset($_SESSION['senha'])) && (isset($_SESSION['admin']))){
    $login = true;
    if($_SESSION['admin'] == 1){
      $admin = true;
    }
  }
  else {
    $login = false;
  }
?>
