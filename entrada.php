<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<main>
  <div class="container">
    <h1>Entrada</h1>

    <form name="entrada" action="validacao_entrada.php" method="post" onSubmit="return validar_entrada()">
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
        } else if (taglen < 4){
          sweetAlert("Oops...", "O campo TAG deve conter 4 dígitos.", "error");
          return false;
        }else{
          return true;
        }
      }
    </script>
  </div>
</main>
<?php include 'footer.php'; ?>
