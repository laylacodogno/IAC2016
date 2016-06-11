<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php include 'authenticate.php';
if(!$admin){ ?>
  <div class="container alert alert-danger">
    <h2>Você não tem permissão para acessar essa página, por favor faça login no sistema.</h2>
  </div>
<?php  die;
}
include 'conexao.php';
$sqlTD = "SELECT * FROM pessoas";
$resultTD = mysqli_query($conexao, $sqlTD);
$qtdusers = mysqli_num_rows($resultTD);
$sqlAD = "SELECT * FROM pessoas WHERE administrador = 1";
$resultAD = mysqli_query($conexao, $sqlAD);
$qtdadmin = mysqli_num_rows($resultAD);
$qtdclient = ($qtdusers - $qtdadmin);
?>
<main>
  <div class="container">
    <h1>Seja bem vindo, <?php  echo $_SESSION['nome'] ?></h1>
  </div>
  <div class="container">
    <h4>O sistema possui atualmente <?php echo $qtdusers ?> usuários, sendo <?php echo $qtdadmin ?> administradores e <?php echo $qtdclient ?> clientes.</h4>
  </div>
</main>
