<?php

    if (isset($_POST['entrada']) &&
        !empty($_POST['tag'])) {

        $tag = $_POST['tag'];

        include 'conexao.php';

        // $sql = "SELECT login, senha FROM pessoas
        //         WHERE login = '$usuario' AND senha = '$senha_hash'";
        // $resultado = mysqli_query($conexao, $sql);
        // $row = mysqli_fetch_all($resultado);
        //
        // if(count($row) == 1) {
        //
        //
        //     // inicia a sessão
        //     session_start();
        //     // criar variáveis de sessão;
        //     $_SESSION['usuario'] = $usuario;
        //     $_SESSION['senha'] = $senha;
        //     // redirecionar
        //     header('location:cadastro_usuario.php');
        //
        //
        // } else {
        //     header('location:login.php?error=1');
        // }

    }

?>
