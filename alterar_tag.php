<?php include 'header.php' ?>
<?php include 'nav.php' ?>
<main>
  <div class="container">
    <?php include 'authenticate.php';
    if(!$admin){ ?>
      <div class="alert alert-danger">
        <h2>Você não tem permissão para acessar essa página, por favor faça login no sistema.</h2>
      </div>
    <?php  die;
    }
    $rowTag = NULL;?>

    <?php
      if (isset($_POST['pesquisar'])) {
        if (!empty($_POST['pesquisar'])) {
          $tag = $_POST['pesquisar'];
          include 'conexao.php';
          $sqlT = "SELECT * FROM tags WHERE id = '$tag';";
          $resultadoT = mysqli_query($conexao,$sqlT);
          $rowTag = mysqli_fetch_row($resultadoT);
          if ($rowTag != NULL) {
            $pessoaId = $rowTag[1];
            $mestra = $rowTag[2];
            $dataInicio = $rowTag[3];
            $dataFim = $rowTag[4];
          }else {
            echo "<h4 class=\"alert alert-warning\">Tag nao encontrado!</h4> ";
          }
        }
      }
    ?>
    <h1 class="text-info">Alterar TAG</h1>
    <div class="formgroup">
      <form class="" action="alterar_tag.php" method="post">
        <div class="form-group">
          <label for="tag">Digite o número da TAG</label>
          <input class="form-control" type="text" name="pesquisar" value="<?php if (isset($_POST['pesquisar'])) {echo $tag ;} ?>">
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit" name="">Pesquisar</button>
        </div>
      </form>
    </div>

    <?php if ($rowTag != NULL): ?>
      <h2>Editar</h2>
      <form class="" action="alterar_tag.php" method="post">
        <div class="form-group">
          <label for="altTag">Número TAG</label>
          <input class="form-control" type="text" name="altTag" value=" <?php echo $tag ?>">
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
        </div>
        <div class="">

        </div>
      </form>
    <?php endif; ?>


  </div>
</main>

<?php include 'footer.php' ?>
