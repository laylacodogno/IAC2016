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
<main>
  <div class="container">
    <div class="jumbotron" style="background-color: #e3f2fd">
      <h1 style="text-align:center;">Sistema de Acesso Eletrônico</h1>
    </div>
      <p style="text-align:center;" >
        <a class="btn btn-primary btn-lg" href="entrada.php">Entrar com TAG</a>
      </p>
  </div>
</main>
<?php }?>
<?php include 'footer.php'; ?>
