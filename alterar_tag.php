<?php include 'header.php' ?>
<?php include 'nav.php' ?>
<?php include 'authenticate.php';
include 'conexao.php';
if(!$admin){ ?>
  <div class="container alert alert-danger">
    <h2>Você não tem permissão para acessar essa página, por favor faça login no sistema.</h2>
  </div>
<?php  die;
}
$rowTag = NULL;?>

<?php
function limpaCaracter($valor){
 $valor = trim($valor);
 $valor = str_replace(".", "", $valor);
 $valor = str_replace(",", "", $valor);
 $valor = str_replace("-", "", $valor);
 $valor = str_replace("/", "", $valor);
 return $valor;
}

  if (isset($_POST['pesquisar'])) {
    if (!empty($_POST['pesquisar'])) {
      $tag = limpaCaracter($_POST['pesquisar']);
      $sqlT = "SELECT * FROM tags WHERE id = '$tag';";
      $resultadoT = mysqli_query($conexao,$sqlT);
      $rowTag = mysqli_fetch_row($resultadoT);
      if ($rowTag != NULL) {
        $pessoaId = $rowTag[1];
        $mestra = $rowTag[2];
        $dataInicio = $rowTag[3];
        $dataFim = $rowTag[4];
        if ($mestra == 1){
          echo "<h4 class=\"alert alert-warning\">Não é possível alterar nem remover tag mestra</h4> ";
          $tag="";
        }
      }else {
        echo "<h4 class=\"alert alert-warning\">Tag nao encontrada!</h4> ";
      }
    }
  }
  if (isset($_POST['altera'])) {
    $tagA = limpaCaracter($_POST['altTag']);
    $update = $_POST['usuario'];

    for ($i=0; $i < 3; $i++) {
    $sqlAL = "UPDATE tags SET pessoa_id = '$update' WHERE id = $tagA;";
    $resultadoAL = mysqli_query($conexao, $sqlAL);
    if ($resultadoAL){
    echo "<h4 class=\"alert alert-success\"> TAG alterada com sucesso.</h4>";
    }
    }
  }
  if (isset($_POST['apagar'])) {
    $tagD = limpaCaracter($_POST['altTag']);
    $sqlD = "DELETE FROM tags WHERE id = '$tagD';";
    $resultadoD = mysqli_query($conexao, $sqlD);
    if ($resultadoD){
    echo "<h4 class=\"alert alert-success\"> TAG removida com sucesso.</h4>";
    }
  }
?>

<main>
  <div class="container">
    <h1 class="text-info">Alterar TAG</h1>
    <div class="formgroup">
      <form class="" action="alterar_tag.php" method="post">
        <div class="form-group">
          <label for="tag">Digite o número da TAG</label>
          <input class="form-control tag-field" type="text" name="pesquisar" value="<?php if (isset($_POST['pesquisar'])) {echo $tag ;} ?>">
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit" name="">Pesquisar</button>
        </div>
      </form>
    </div>

    <?php if (($rowTag != NULL) && ($mestra==0)): ?>
      <h2>Editar</h2>
      <form class="" action="alterar_tag.php" method="post">
        <div class="form-group">
          <label for="altTag">Número TAG</label>
          <input class="form-control tag-field" type="text" name="altTag" value="<?php echo $tag ?>">
        </div>
        <div class="form-group">
          <label for="usuario">Usuário</label>
          <?php
              $sqlPes = "SELECT * FROM pessoas";
              $resultadoPes = mysqli_query($conexao, $sqlPes);
              $rowsP = mysqli_fetch_all($resultadoPes);
          ?>
          <select name="usuario" id="usuario" class="form-control">
            <?php
            for ($i=0; $i < count($rowsP); $i++) {
                $id_pes = $rowsP[$i][0];
                $nome_pes = $rowsP[$i][1];
                echo "<option value=\"$id_pes\"";
                if ($pessoaId == $id_pes) {
                  echo"selected";
                }
                echo ">$nome_pes</option>";
            }?>
          </select>
          <div class="form-group">
            <button class="btn btn-success" type="submit" name="altera">Alterar</button>
          </div>
          <button class="btn btn-danger" type="" name="apagar">Apagar TAG</button>

    <?php endif; ?>

  </div>
</main>

<?php include 'footer.php' ?>
