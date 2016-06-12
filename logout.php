<?php
    session_start();
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    unset($_SESSION['admin']);
    unset($_SESSION['nome']);

    session_destroy();
    header('location:index.php');

?>
