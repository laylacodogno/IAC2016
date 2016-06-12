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

    <?php
      if (isset($_POST['cadastrarTag'])) {
        if (!empty($_POST['tag']) &&
            !empty($_POST['tagMaster']) &&
            !empty($_POST['usuario'])  &&
            !empty($_POST['dataInicio'])  &&
            !empty($_POST['dataFim'])) {

              function limpaCaracter($valor){
               $valor = trim($valor);
               $valor = str_replace(".", "", $valor);
               $valor = str_replace(",", "", $valor);
               $valor = str_replace("-", "", $valor);
               $valor = str_replace("/", "", $valor);
               return $valor;
              }

          $tag = intval(limpaCaracter($_POST['tag']));
          $tagMaster = intval(limpaCaracter($_POST['tagMaster']));
          $usuario = intval($_POST['usuario']);
          $dataInicio = $_POST['dataInicio'];
          $dataFim = $_POST['dataFim'];

          include 'conexao.php';

          $sqlTM = "SELECT * FROM tags
                    WHERE id = '$tagMaster' AND mestra = 1";
          $resultadoTM = mysqli_query($conexao, $sqlTM);

          if ($resultadoTM) {
            $sqlT = "INSERT INTO tags (id, pessoa_id, mestra, data_inicio, data_fim)
                    VALUES ('$tag', '$usuario', 0, '$dataInicio', '$dataFim');";
            $resultadoT = mysqli_query($conexao, $sqlT);

            if ($resultadoT) {
              $tag_id = $tag;

              if ($_POST['segundaEnt'] != ''  && $_POST['segundaSai'] != '') {
                $segundaEnt = date( 'H:i:s', strtotime($_POST['segundaEnt']));
                $segundaSai = date( 'H:i:s', strtotime($_POST['segundaSai']));

                $sqlSe = "INSERT INTO restricoes (tag_id, dia, horario_entrada, horario_saida )
                        VALUES ('$tag_id', 1, '$segundaEnt', '$segundaSai')";
                $resultadoSe = mysqli_query($conexao, $sqlSe);
              }

              if ($_POST['tercaEnt'] != ''  && $_POST['tercaSai'] != '') {
                $tercaEnt = date( 'H:i:s', strtotime($_POST['tercaEnt']));
                $tercaSai = date( 'H:i:s', strtotime($_POST['tercaSai']));

                $sqlTr = "INSERT INTO restricoes (tag_id, dia, horario_entrada, horario_saida )
                        VALUES ('$tag_id', 2, '$tercaEnt', '$tercaSai')";
                $resultadoTr = mysqli_query($conexao, $sqlTr);
              }


              if ($_POST['quartaEnt'] != ''  && $_POST['quartaSai'] != '') {
                $quartaEnt = date( 'H:i:s', strtotime($_POST['quartaEnt']));
                $quartaSai = date( 'H:i:s', strtotime($_POST['quartaSai']));

                $sqlQa = "INSERT INTO restricoes (tag_id, dia, horario_entrada, horario_saida )
                        VALUES ('$tag_id', 3, '$quartaEnt', '$quartaSai')";
                $resultadoQa = mysqli_query($conexao, $sqlQa);
              }
              if ($_POST['quintaEnt'] != ''  && $_POST['quintaSai'] != '') {
                $quintaEnt = date( 'H:i:s', strtotime($_POST['quintaEnt']));
                $quintaSai = date( 'H:i:s', strtotime($_POST['quintaSai']));

                $sqlQi = "INSERT INTO restricoes (tag_id, dia, horario_entrada, horario_saida )
                        VALUES ('$tag_id', 4, '$quintaEnt', '$quintaSai')";
                $resultadoQi = mysqli_query($conexao, $sqlQi);
              }
              if ($_POST['sextaEnt'] != ''  && $_POST['sextaSai'] != '') {
                $sextaEnt = date( 'H:i:s', strtotime($_POST['sextaEnt']));
                $sextaSai = date( 'H:i:s', strtotime($_POST['sextaSai']));

                $sqlSx = "INSERT INTO restricoes (tag_id, dia, horario_entrada, horario_saida )
                        VALUES ('$tag_id', 5, '$sextaEnt', '$sextaSai')";
                $resultadoSx = mysqli_query($conexao, $sqlSx);
              }
              if ($_POST['sabadoEnt'] != ''  && $_POST['sabadoSai'] != '') {
                $sabadoEnt = date( 'H:i:s', strtotime($_POST['sabadoEnt']));
                $sabadoSai = date( 'H:i:s', strtotime($_POST['sabadoSai']));

                $sqlSb = "INSERT INTO restricoes (tag_id, dia, horario_entrada, horario_saida )
                        VALUES ('$tag_id', 6, '$sabadoEnt', '$sabadoSai')";
                $resultadoSb = mysqli_query($conexao, $sqlSb);
              }
              if ($_POST['domingoEnt'] != ''  && $_POST['domingoSai'] != '') {
                $domingoEnt = date( 'H:i:s', strtotime($_POST['domingoEnt']));
                $domingoSai = date( 'H:i:s', strtotime($_POST['domingoSai']));

                $sqlDo = "INSERT INTO restricoes (tag_id, dia, horario_entrada, horario_saida )
                        VALUES ('$tag_id', 7, '$domingoEnt', '$domingoSai')";
                $resultadoDo = mysqli_query($conexao, $sqlDo);
              }



              header('location:cadastro_tag.php?sucess=1');

            }else{
              header('location:cadastro_tag.php?error=3');

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
        <input type="text" class="form-control tag-field" id="tag" name="tag" placeholder="Tag">
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
        <input type="text" class="form-control tag-field" id="tagMaster" name="tagMaster" placeholder="Tag Master">
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


      <button class="btn btn-primary" type="submit" name="cadastrarTag">Cadastrar</button>
    </form>
    <script language="javascript" type="text/javascript">
        function validar_cadastroTag() {
          var tagMaster = cadastroTag.tagMaster.value.replace(/[^\d]+/g,'');
          var tag = cadastroTag.tag.value.replace(/[^\d]+/g,'');
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
