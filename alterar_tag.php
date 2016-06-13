<?php include 'header.php' ?>
<?php include 'nav.php' ?>
<?php include 'authenticate.php';
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
            echo "<p class=\"text-warning\">Tag nao encontrado!</p> ";
          }
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

    <?php if ($rowTag != NULL): ?>
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
        </div>
        <div class="form-group">
          <label for="dataInicio">Data Inicio:</label>
          <input type="date" class="form-control" id="dataInicio" name="dataInicio" placeholder="Data Inicio">
        </div>
        <div class="form-group">
          <label for="dataFim">Data Fim:</label>
          <input type="date" class="form-control" id="dataFim" name="dataFim" placeholder="Data Fim">
        </div>
        <p>
          Selecione os dias permitidos e o horario.
        </p>
        <div class="restricao-dia">
          <p>
            Segunda
          </p>
          <div class="form-group">
            <label for="segundaEnt">Horario Entrada:</label>
            <input type="time" class="form-control" id="segundaEnt" name="segundaEnt" placeholder="Horario Entrada">
          </div>
          <div class="form-group">
            <label for="segundaSai">Horario Saida:</label>
            <input type="time" class="form-control" id="segundaSai" name="segundaSai" placeholder="Horario Saida">
          </div>
        </div>
        <div class="restricao-dia">
          <p>
            Terça
          </p>
          <div class="form-group">
            <label for="tercaEnt">Horario Entrada:</label>
            <input type="time" class="form-control" id="tercaEnt" name="tercaEnt" placeholder="Horario Entrada">
          </div>
          <div class="form-group">
            <label for="tercaSai">Horario Saida:</label>
            <input type="time" class="form-control" id="tercaSai" name="tercaSai" placeholder="Horario Saida">
          </div>
        </div>
        <div class="restricao-dia">
          <div class="form-group">
            <label for="quartaEnt">Horario Entrada:</label>
            <input type="time" class="form-control" id="quartaEnt" name="quartaEnt" placeholder="Horario Entrada">
          </div>
          <div class="form-group">
            <label for="quartaSai">Horario Saida:</label>
            <input type="time" class="form-control" id="quartaSai" name="quartaSai" placeholder="Horario Saida">
          </div>
        </div>
        <div class="restricao-dia">
          <div class="form-group">
            <label for="quintaEnt">Horario Entrada:</label>
            <input type="time" class="form-control" id="quintaEnt" name="quintaEnt" placeholder="Horario Entrada">
          </div>
          <div class="form-group">
            <label for="quintaSai">Horario Saida:</label>
            <input type="time" class="form-control" id="quintaSai" name="quintaSai" placeholder="Horario Saida">
          </div>
        </div>
        <div class="restricao-dia">
          <div class="form-group">
            <label for="sextaEnt">Horario Entrada:</label>
            <input type="time" class="form-control" id="sextaEnt" name="sextaEnt" placeholder="Horario Entrada">
          </div>
          <div class="form-group">
            <label for="sextaSai">Horario Saida:</label>
            <input type="time" class="form-control" id="sextaSai" name="sextaSai" placeholder="Horario Saida">
          </div>
        </div>
        <div class="restricao-dia">
          <div class="form-group">
            <label for="sabadoEnt">Horario Entrada:</label>
            <input type="time" class="form-control" id="sabadoEnt" name="sabadoEnt" placeholder="Horario Entrada">
          </div>
          <div class="form-group">
            <label for="sabadoSai">Horario Saida:</label>
            <input type="time" class="form-control" id="sabadoSai" name="sabadoSai" placeholder="Horario Saida">
          </div>
        </div>
        <div class="restricao-dia">
          <div class="form-group">
            <label for="domingoEnt">Horario Entrada:</label>
            <input type="time" class="form-control" id="domingoEnt" name="domingoEnt" placeholder="Horario Entrada">
          </div>
          <div class="form-group">
            <label for="domingoSai">Horario Saida:</label>
            <input type="time" class="form-control" id="domingoSai" name="domingoSai" placeholder="Horario Saida">
          </div>
        </div>
        <button class="btn btn-primary" type="submit" name="cadastrarTag">Editar</button>
      </form>
    <?php endif; ?>

  </div>
</main>

<?php include 'footer.php' ?>
