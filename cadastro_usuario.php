<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<main>
  <div class="container">
    <?php
      if (isset($_POST['cadastrarUsuario'])) {

      }

    ?>
    <h2 class="text-info">Cadastrar Usuário</h2>
    <form name="cadastrarUsuario" action="cadastro_usuario.php" method="post" onSubmit="return validar_cadastroUsuario()">
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
      </div>
      <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control cpf-field" id="cpf" name="cpf" placeholder="CPF">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="login">Login:</label>
        <input type="text" class="form-control" id="login" name="login" placeholder="Login">
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
      </div>
      <div class="form-group">
        <label for="senhaConf">Confirmar Senha:</label>
        <input type="password" class="form-control" id="senhaConf" name="senhaConf" placeholder="Confirmar Senha">
      </div>
      <div class="form-group">
        <label for="admin"><input type="checkbox" class="form-control" id="admin" name="admin"> Administrador</label>
      </div>

      <button class="btn btn-primary" type="submit" name="cadastrar">Cadastrar</button>
    </form>
    
    <script language="javascript" type="text/javascript">
      function validar_cadastroUsuario() {

      }
    </script>
  </div>
</main>
<?php include 'footer.php'; ?>
