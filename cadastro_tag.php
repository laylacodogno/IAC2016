<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<main>
  <div class="container">

    <?php
      if (isset($_POST['cadastrarTag'])) {
        if (!empty($_POST['tag']) &&
            !empty($_POST['tagMaster']) &&
            !empty($_POST['usuario'])) {

          $tag = intval($_POST['tag']);
          $tagMaster = intval($_POST['tagMaster']);
          $usuario = intval($_POST['usuario']);

          var_dump($usuario);

          include 'conexao.php';

          $sqlTM = "SELECT * FROM tags
                    WHERE id = '$tagMaster' AND mestra = 1";
          $resultadoTM = mysqli_query($conexao, $sqlTM);

          if ($resultadoTM) {
            $sqlT = "INSERT INTO tags (id, pessoa_id, mestra)
                    VALUES ('$tag', '$usuario', 0);";
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
      <button class="btn btn-primary" type="submit" name="cadastrarTag">Cadastrar</button>
    </form>
    <script language="javascript" type="text/javascript">
        function validar_cadastroTag() {
          var tagMaster = cadastrarTag.tagMaster.value;
          var tag = cadastrarTag.tag.value;
          var usuario = cadastrarTag.usuario.value;

          if (tag = '' || tagMaster = '' || usuario = '') {
            sweetAlert("Oops...", "Preencha todos os campos.", "error");
            return false;
          }else if ((tag != 9 || tagMaster != 9) {
            sweetAlert("Oops...", "Tag deve conter 9 dígitos.", "error");
            return false;
          }else{
            return true;
          }
        }
    </script>
  </div>
</main>
<?php include 'footer.php'; ?>
