<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<main>
  <div class="container">
    <h1>Entrada</h1>
    <?php

      if (isset($_POST['tag'])) {

          function limpaCaracter($valor){
           $valor = trim($valor);
           $valor = str_replace(".", "", $valor);
           $valor = str_replace(",", "", $valor);
           $valor = str_replace("-", "", $valor);
           $valor = str_replace("/", "", $valor);
           return $valor;
          }

          $tag = limpaCaracter($_POST['tag']);

          include 'conexao.php';

          $sqlT = "SELECT * FROM tags WHERE id = '$tag';";
          $resultadoT = mysqli_num_rows(mysqli_query($conexao, $sqlT));


          if ($resultadoT == 1) {
            $sqlR = "SELECT * FROM restricoes WHERE tag_id = '$tag';";
            $resultadoR = mysqli_query($conexao, $sqlR);
            $rows = mysqli_fetch_all($resultadoR);
            // var_dump($rows); die();
            setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');

            $dia_atual = strftime('%A', strtotime('today'));
            $hora_atual = date('H:i:s');

            // var_dump($dia_atual); var_dump($hora_atual); die();

            foreach ($rows as $row) {
              foreach ($row as $key => $value) {
                if ($key == 4) {
                  if ($value == $dia_atual) {
                    $dia_check = true;
                  }else{
                    $dia_check = false;
                    header('location:entrada.php?error=4');
                  }
                }elseif ($key == 3) {
                  if ($value >= $hora_atual) {
                    $horaS_check = true;
                  }else{
                    $horaS_check = false;
                    header('location:entrada.php?error=4');
                  }
                }elseif ($key == 2) {
                  if ($value <= $hora_atual) {
                    $horaE_check = true;
                  }else{
                    $horaE_check = false;
                    header('location:entrada.php?error=4');
                  }
                }
              }
            }

            if ($dia_check && $horaE_check && $horaS_check) {
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
            }


          }else {
            //echo "Não tem tag";
            header('location:entrada.php?error=2'); //erro nao ha tag no BD
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
        }elseif ($error == 4) {
          echo "<p class=\"text-warning\">Acesso Negado.</p>";
        }
      }elseif (!empty($_GET['sucess'])) {
        $sucess = $_GET['sucess'];
        if ($sucess == 1) {
          echo "<p class=\"text-success\">Entrada Efetuada!</p>";
        }
      }
    ?>
    <form name="entrada" action="" method="post" onSubmit="return validar_entrada()">
      <div class="form-group">
        <label for="tag">TAG:</label>
        <input type="text" class="form-control tag-field" id="tag" name="tag" placeholder="Tag">
      </div>

      <button class="btn btn-primary" type="submit" name="registrar">Registrar</button>
    </form>

    <script language="javascript" type="text/javascript">
      function validar_entrada() {
        var tag = entrada.tag.value.replace(/[^\d]+/g,'');
        var taglen = tag.length;
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
