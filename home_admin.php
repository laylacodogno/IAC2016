<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php include 'authenticate.php';
if(!$admin){ ?>
  <div class="container alert alert-danger">
    <h2>Você não tem permissão para acessar essa página, por favor faça login no sistema.</h2>
  </div>
<?php  die;
}?>
<main>
  <div class="container">
    <h1>Seja bem vindo, <?php  echo $_SESSION['nome'] ?></h1>
  </div>
</main>
