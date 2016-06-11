<?php include 'header.php' ?>
<?php include 'nav.php' ?>
<?php include 'authenticate.php';
if(!$admin){ ?>
  <div class="container alert alert-danger">
    <h2>Você não tem permissão para acessar essa página, por favor faça login no sistema.</h2>
  </div>
<?php  die;
}?>

<?php
  if (isset($_POST['usuario'])) {
    if (!empty($_POST['usuario'])) {
      $cpf=limpaCaracter($_POST['usuario']);
      include 'conexao.php';
      $sqlU = "SELECT * FROM pessoas WHERE cpf = '$cpf'";
      $resultadoU = mysqli_query($conexao, $sqlU);
      $rowU = mysql_fetch_row($resultadoU);
      var_dump($rowU);
    }
  }
?>

<main>
  <div class="container">
    <h1>Alterar Usuário</h1>
    <form name="editar" id="editar" action="alterar_usuario.php" method="post">
      <div class="form-group">
        <label for="usuario">Digite o CPF do Usuário:</label>
        <input type="text" class="form-control cpf-field" name="usuario" value="">
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit" name="">Editar</button>
      </div>
    </form>
  </div>
</main>
<?php function limpaCaracter($valor){
 $valor = trim($valor);
 $valor = str_replace(".", "", $valor);
 $valor = str_replace(",", "", $valor);
 $valor = str_replace("-", "", $valor);
 $valor = str_replace("/", "", $valor);
 return $valor;
} ?>
<?php include 'footer.php' ?>
