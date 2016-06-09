<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<main>
  <div class="container">
    <?php
    if (isset($_SESSION['usuario'])) {
      if ($_SESSION['admin'] = 1) {
        header('location:home_admin.php');
      }else{
          header('location:home_usuario.php');
      }
    }

              if (!empty($_GET['error'])) {

                  $error = $_GET['error'];
                  if ($error == 1) {
                      echo "<p class=\"text-warning\">Login ou senha inválidos</p>";

                  }
              }

          ?>
          <h2 class="text-info">Entrar no Sistema</h2>

          <form name="login" action="validacao_login.php" method="post" onSubmit="return validar_login()">
            <div class="form-group">
              <label for="usuario">Usuário:</label>
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário">
            </div>
            <div class="form-group">
              <label for="senha">Senha:</label>
              <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
            </div>

            <button class="btn btn-primary" type="submit" name="entrar">Entrar</button>
          </form>
          <script language="javascript" type="text/javascript">
            function validar_login() {
              var usuario = login.usuario.value;
              var senha = login.senha.value;
              if (usuario == '' || senha == '') {
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
