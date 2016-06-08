<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>

<main>
<div class="container">
  <?php
    if (isset($_POST['cadastroTag'])) {
      if (!empty($_POST['tagMaster'] &&)
          !empty($_POST['tagNovo'] && ) {
        $master = $_POST['tagMaster'];
        $novo = $_POST['tagNovo'];
        if (!empty($_POST['master'])) {
          $novoMaster = intval($_POST['master']);
        }else{
          $novoMaster = 0;
        }

      }
    }
  ?>
  <h2 class="text-info">Cadastrar TAG</h2>
  <form name="cadastroTag" onSubmit="return validar_tag()"  method="post">
    <div class="form-group">
      <label for="tagMaster">TAG Master:</label>
      <input type="text" class="form-control" id="tagMaster" name="tagMaster" placeholder="TAG Master">
    </div>
    <div class="form-group">
      <label for="tagNovo">TAG para Cadastro:</label>
      <input type="text" class="form-control" id="tagNovo" name="tagNovo" placeholder="Novo TAG">
    </div>
    <div class="form-group">
      <label for="master"><input type="checkbox" id="master" name="master"> &nbsp Novo TAG Master</label>
    </div>
    <button class="btn btn-primary" type="submit" name="entrar">Cadastrar</button>
  </form>
  <script language="javascript" type="text/javascript">

    function validar_tag() {
      var tagMaster = cadastroTag.tagMaster.value;
      var tagNovo = cadastroTag.tagNovo.value;

      if (tagNovo == '' || tagMaster == '') {
        sweetAlert("Oops...", "Preencha todos os campos.", "error");
        return false;
      }else{
        return true;
      }
    }
  </script>
</div>


  </main>
  <?php include 'footer.php'; ?>
