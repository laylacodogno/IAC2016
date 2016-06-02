<?php

    if (isset($_POST['entrar']) &&
        !empty($_POST['usuario']) &&
        !empty($_POST['senha'])) {

        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $senha_hash = md5($senha);

        include 'conexao.php';

        $sql = "SELECT usuario, senha FROM pessoas
                WHERE login = '$usuario' AND senha = '$senha_hash'";
        $resultado = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

        if(mysqli_num_rows($resultado) == 1) {

            // inicia a sessão
            session_start();
            // criar variáveis de sessão;
            $_SESSION['usuario'] = $usuario;
            $_SESSION['senha'] = $senha;
            // redirecionar
            header('location:cadastro_usuario.php');


        } else {
            header('location:login.php?error=1');
        }

    } else {
        header('location:login.php?error=2');
    }

?>
