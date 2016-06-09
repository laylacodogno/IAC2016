<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<main>
  <div class="container">
    <h1>Entrada</h1>
    <?php

      if (isset($_POST['tag'])) {
        if (strlen($_POST['tag']) == 9) {
          $tag = $_POST['tag'];
          include 'conexao.php';

          $sqlT = "SELECT * FROM tags WHERE id = '$tag';";
          $resultadoT = mysqli_num_rows(mysqli_query($conexao, $sqlT));
          if ($resultadoT==1) {
            $sql = "INSERT INTO entradas (data, tag_id)
            VALUES (CURRENT_TIMESTAMP,'$tag');";
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado) {
              //echo "Sucesso1";
              header('location:entrada.php?sucess=1');
            }else {
              //echo "Erro Inserção";
              header('location:entrada.php?error=3'); //erro na insercao
            }
          }else {
            //echo "Não tem tag";
            header('location:entrada.php?error=2'); //erro nao ha tag no BD
          }
        }else {
          //echo "Trapézio descendente";
          header('location:entrada.php?error=1'); // erro numero da tag < 9
        }
      }
      if (!empty($_GET['error'])) {

        $error = $_GET['error'];
        if ($error == 1) {
          echo "<p class=\"text-warning\">A TAG deve conter 9 dígitos.</p>";
        }elseif ($error == 2) {
          echo "<p class=\"text-warning\">Essa TAG não existe.</p>";
        }elseif ($error == 3) {
          echo "<p class=\"text-warning\">Não foi possível realizar a solicitação.</p>";
        }
      }elseif (!empty($_GET['sucess'])) {
        $sucess = $_GET['sucess'];
        if ($sucess == 1) {
          echo "<p class=\"text-warning\">Entrada Efetuada!</p>";
        }
      }
    ?>
    <form name="entrada" action="" method="post" onSubmit="return validar_entrada()">
      <div class="form-group">
        <label for="tag">TAG:</label>
        <input type="text" class="form-control" id="tag" name="tag" placeholder="TAG">
      </div>

      <button class="btn btn-primary" type="submit" name="registrar">Registrar</button>
    </form>

    <script language="javascript" type="text/javascript">
      function validar_entrada() {
        var tag = entrada.tag.value;
        var taglen = entrada.tag.value.length;
        console.log(taglen);

        if (tag == '') {
          sweetAlert("Oops...", "Preencha o campo corretamente.", "error");
          return false;
        } else if (taglen != 9){
          sweetAlert("Oops...", "O campo TAG deve conter 9 dígitos.", "error");
          return false;
        }else{
          return true;
        }
      }
    </script>
  </div>
</main>
<?php include 'footer.php'; ?>
