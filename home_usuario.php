<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php include 'authenticate.php';
if((!$login) || ($admin)){ ?>
  <div class="container alert alert-danger">
    <h2>Você não tem permissão para acessar essa página, por favor faça login no sistema.</h2>
  </div>
<?php  die;
}?>
<style media="screen">
  .gi-100{font-size: 6em;}
  a {
    text-decoration: none;
  }
</style>
<main>
  <div class="container">
    <h1>Seja bem vindo, <?php  echo $_SESSION['nome'] ?> </h1><br>
    <a href="relatorio_usuario.php" >
    <p style="text-align:center">
        <span class="glyphicon glyphicon-search gi-100"></span>
        <h3 style="text-align:center">Relatórios</h3>
    </p>
    </a>
  </div>
</main>
