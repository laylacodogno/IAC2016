<?php

    if (isset($_POST['entrar']) &&
        !empty($_POST['usuario']) &&
        !empty($_POST['senha'])) {

        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $senha_hash = md5($senha);

        include 'conexao.php';

        $sql = "SELECT * FROM pessoas
                WHERE login = '$usuario' AND senha = '$senha_hash'";
        $resultado = mysqli_query($conexao, $sql);
        $rows = mysqli_fetch_all($resultado);
        // print_r($rows);
        // die;
        if(count($rows) == 1) {


            // inicia a sessão
            session_start();
            // criar variáveis de sessão;
            $_SESSION['usuario'] = $usuario;
            $_SESSION['senha'] = $senha;
            $_SESSION['nome'] = $rows[0][1];
            $_SESSION['admin'] = $rows[0][3];
            // print_r(  $_SESSION['admin']);
            // die;
            // redirecionar
            if ($_SESSION['admin'] == "1") {
              header('location:home_admin.php');
            }else{
                header('location:home_usuario.php');
            }


        } else {
            header('location:login.php?error=1');
        }

    } else {
        header('location:login.php?error=2');
    }

?>
