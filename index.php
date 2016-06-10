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
    <h1>Seja bem vindo</h1>
  </div>
</main>
<?php }?>
<?php include 'footer.php'; ?>
