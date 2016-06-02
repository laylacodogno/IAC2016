<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<main>
  <?php

            if (!empty($_GET['error'])) {

                $error = $_GET['error'];
                if ($error == 1) {
                    echo "<h3 class=\"text-warning\">Login ou senha inválidos</h3>";
                } elseif ($error == 2) {
                    echo "<h3 class=\"text-warning\">Preencha o formulário</h3>";
                }
            }

        ?>
        <h2 class="text-info">Entrar no Sistema</h2>

        <form name="login" action="validacao_login.php" method="post">
          <div class="input-group">
            <span class="input-group-addon" id="usuario">Usuário:</span>
            <input type="text" class="form-control" aria-describedby="usuario" name="usuario"  required="true">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="senha">Senha:</span>
            <input type="password" class="form-control" aria-describedby="senha" name="senha"  required="true">
          </div>

          <button class="btn btn-success" type="submit" name="entrar">Entrar</button>
        </form>

</main>
<?php include 'footer.php'; ?>
