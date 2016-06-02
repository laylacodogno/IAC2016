<?php
$bdServidor = 'localhost'; $bdUsuario = 'root'; $bdSenha = ''; $bdBanco = 'iac';
$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

if (mysqli_connect_errno($conexao)) { 
  echo "Problemas para conectar no banco. Verifique os dados!";
  die();
}
?>
