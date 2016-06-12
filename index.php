<?php
  session_start();
  if (isset($_SESSION['admin'])){
  if ($_SESSION['admin'] == 0){
    include 'home_usuario.php';
  }
  else if($_SESSION['admin'] == 1){
    include 'home_admin.php';
  }
}
else{ ?>
<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<main class="index">
  <div class="container">
    <div class="jumbotron">
    <div class="container">
        <h1>Sistema de Acesso Eletrônico</h1>
        <p><a class="btn btn-primary btn-lg" href="entrada.php">Entrar com TAG</a></p>
    </div>
</main>
<?php }?>
<?php include 'footer.php'; ?>
