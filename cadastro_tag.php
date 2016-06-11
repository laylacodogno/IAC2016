<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>

<main>
  <div class="container">

    <?php
      if (isset($_POST['cadastrarTag'])) {
        if (!empty($_POST['tag']) &&
            !empty($_POST['tagMaster']) &&
            !empty($_POST['usuario'])  &&
            !empty($_POST['dataInicio'])  &&
            !empty($_POST['dataFim'])) {

          $tag = intval($_POST['tag']);
          $tagMaster = intval($_POST['tagMaster']);
          $usuario = intval($_POST['usuario']);
          $dataInicio = $_POST['dataInicio'];
          $dataFim = $_POST['dataFim'];
          $segundaEnt = $_POST['segundaEnt'];
          $segundaSai = $_POST['segundaSai'];
          $tercaEnt = $_POST['tercaEnt'];
          $tercaSai = $_POST['tercaSai'];
          $quartaEnt = $_POST['quartaEnt'];
          $quartaSai = $_POST['quartaSai'];
          $quintaEnt = $_POST['quintaEnt'];
          $quintaSai = $_POST['quintaSai'];
          $sextaEnt = $_POST['sextaEnt'];
          $sextaSai = $_POST['sextaSai'];
          $sabadoEnt = $_POST['sabadoEnt'];
          $sabadoSai = $_POST['sabadoSai'];
          $domingoEnt = $_POST['domingoEnt'];
          $domingoSai = $_POST['domingoSai'];

          var_dump($tercaEnt);
          die();

          include 'conexao.php';

          $sqlTM = "SELECT * FROM tags
                    WHERE id = '$tagMaster' AND mestra = 1";
          $resultadoTM = mysqli_query($conexao, $sqlTM);

          if ($resultadoTM) {
            $sqlT = "INSERT INTO tags (id, pessoa_id, mestra, data_inicio, data_fim)
                    VALUES ('$tag', '$usuario', 0, $dataInicio, $dataFim);";
            $resultadoT = mysqli_query($conexao, $sqlT);

            if (!$resultadoT) {
              header('location:cadastro_tag.php?error=3');
            }else{
              header('location:cadastro_tag.php?sucess=1');
            }
          }else{
            header('location:cadastro_tag.php?error=2');
          }

        }else{
          header('location:cadastro_tag.php?error=1');
        }
      }
      if (!empty($_GET['error'])) {
          $error = $_GET['error'];

          if ($error == 3) {
              echo "<p class=\"text-warning\">Cadastro Não Efetuado.</p>";

          }else if ($error == 2) {
            echo "<p class=\"text-warning\">Tag Master inválida.</p>";
          }else if ($error == 1) {
            echo "<p class=\"text-warning\">Não foi possivel cadastrar.</p>";
          }

      }else if (!empty($_GET['sucess'])) {
        $sucess = $_GET['sucess'];
        if ($sucess == 1) {
          echo "<p class=\"text-warning\">Cadastro Efetuado.</p>";
        }
      }
    ?>

    <h2 class="text-info">Cadastrar Tag</h2>
    <form name="cadastroTag" action=""  method="post" onSubmit="return validar_cadastroTag()">
      <div class="form-group">
        <label for="tag">Tag:</label>
        <input type="text" class="form-control" id="tag" name="tag" placeholder="Tag">
      </div>
      <div class="form-group">
        <label for="usuario">Usuário:</label>
        <?php
            include 'conexao.php';
            $sql = "SELECT * FROM pessoas";
            $resultado = mysqli_query($conexao, $sql);
            $rows = mysqli_fetch_all($resultado);

            if (count($rows) > 0) {
        ?>
        <select name="usuario" id="usuario" class="form-control">
            <?php

            for ($i=0; $i < count($rows); $i++) {
                $id_pes = $rows[$i][0];
                $nome_pes = $rows[$i][1];
                echo "<option value=\"$id_pes\">$nome_pes</option>";
            }

            ?>
        </select>
        <?php
            } else {
                echo "<p class=\"bg-warning\"><p>Você deve cadastrar ao menos um usuário.</p></p>";
            }
        ?>
      </div>
      <div class="form-group">
        <label for="tagMaster">Tag Master:</label>
        <input type="text" class="form-control" id="tagMaster" name="tagMaster" placeholder="Tag Master">
      </div>
      <div class="form-group">
        <label for="dataInicio">Data Inicio:</label>
        <input type="date" class="form-control" id="dataInicio" name="dataInicio" placeholder="Data Inicio">
      </div>
      <div class="form-group">
        <label for="dataFim">Data Fim:</label>
        <input type="date" class="form-control" id="dataFim" name="dataFim" placeholder="Data Fim">
      </div>
      <div class="restricao-dia">
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


      <button class="btn btn-primary" type="submit" name="cadastrarTag">Cadastrar</button>
    </form>
    <script language="javascript" type="text/javascript">
        function validar_cadastroTag() {
          var tagMaster = cadastroTag.tagMaster.value;
          var tag = cadastroTag.tag.value;
          var usuario = cadastroTag.usuario.value;
          var dataInicio = cadastroTag.dataInicio.value;
          var dataFim = cadastroTag.dataFim.value;

          if (tag == '' || tagMaster == '' || usuario == '' || dataInicio == '' || dataFim == '') {
            sweetAlert("Oops...", "Preencha todos os campos.", "error");
            return false;
          } else if (tag.length != 9 || tagMaster.length != 9) {
            sweetAlert("Oops...", "Tag deve conter 9 dígitos.", "error");
            return false;
          } else if (dataFim < dataInicio) {
            sweetAlert("Oops...", "Data de Fim deve ser maior que Data de Inicio.", "error");
            return false;
          } else{
            return true;
          }
        }
    </script>
  </div>
</main>
<?php include 'footer.php'; ?>
