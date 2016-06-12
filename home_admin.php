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

<p style="text-align:center">
  <a href="relatorio_admin.php" >
      <span class="glyphicon glyphicon-list gi-100"></span>
      <span>Relatórios</span>
  </a>
  <a href="alterar_usuario.php" >
      <span class="glyphicon glyphicon-user gi-100"></span>
      <span>Alterar Usuário</span>
  </a>
  <a href="entrada.php" >
      <span class="glyphicon glyphicon-home gi-100"></span>
      <span>Entrar com TAG</span>
  </a>
  <a href="pesquisa_tag.php" >
      <span class="glyphicon glyphicon-search gi-100"></span>
      <span>Pesquisar TAG</span>
  </a>
  <a href="alterar_tag.php" >
      <span class="glyphicon glyphicon-tag gi-100"></span>
      <span>Alterar TAG</span>
  </a>
</p>
  </div>
</main>
