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
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control cpf-field" id="cpf" name="cpf" placeholder="CPF">
      </div>
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
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
        var cpf = cadastrarUsuario.cpf.value;

        var nome = cadastrarUsuario.nome.value;
        var email = cadastrarUsuario.email.value;
        var login = cadastrarUsuario.login.value;
        var senha = cadastrarUsuario.senha.value;
        var senhaConf = cadastrarUsuario.senhaConf.value;
        var admin = cadastrarUsuario.admin.value;

        if (cpf == '' || nome == '' || email == ''|| login == ''|| senha == ''|| senhaConf == '' ) {
          sweetAlert("Oops...", "Preencha todos os campos.", "error");
          return false;
        }else if(senha != senhaConf){
          sweetAlert("Oops...", "Os campos de Senha precisam ser iguais.", "error");
          return false;
        }else{
          if(cpf != ''){
            cpf = cpf.replace(/[^\d]+/g,'');
            // Elimina CPFs invalidos conhecidos
            if (cpf.length != 11 ||
                cpf == "00000000000" ||
                cpf == "11111111111" ||
                cpf == "22222222222" ||
                cpf == "33333333333" ||
                cpf == "44444444444" ||
                cpf == "55555555555" ||
                cpf == "66666666666" ||
                cpf == "77777777777" ||
                cpf == "88888888888" ||
                cpf == "99999999999"){
              sweetAlert("Oops...", "CPF inválido.", "error");
              return false;
            }
            // Valida 1o digito
            add = 0;
            for (i=0; i < 9; i ++)
                add += parseInt(cpf.charAt(i)) * (10 - i);
                rev = 11 - (add % 11);
                if (rev == 10 || rev == 11)
                    rev = 0;
                if (rev != parseInt(cpf.charAt(9)))
                    sweetAlert("Oops...", "CPF inválido.", "error");
                    return false;
            // Valida 2o digito
            add = 0;
            for (i = 0; i < 10; i ++)
                add += parseInt(cpf.charAt(i)) * (11 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(10)))
                sweetAlert("Oops...", "CPF inválido.", "error");
                return false;
          }else{
            return true;
          }
        }
      }
    </script>
  </div>
</main>
<?php include 'footer.php'; ?>
