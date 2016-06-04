<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<main>
  <div class="container">
    <?php
      if (isset($_POST['cadastrarUsuario'])) {
        if (!empty($_POST['cpf']) &&
            !empty($_POST['nome']) &&
            !empty($_POST['login']) &&
            !empty($_POST['senha']) &&
            !empty($_POST['senhaConf']) &&
            !empty($_POST['departamento']) &&
            !empty($_POST['cep']) &&
            !empty($_POST['numero']) ) {

            function limpaCaracter($valor){
             $valor = trim($valor);
             $valor = str_replace(".", "", $valor);
             $valor = str_replace(",", "", $valor);
             $valor = str_replace("-", "", $valor);
             $valor = str_replace("/", "", $valor);
             return $valor;
            }

              $CPF = limpaCaracter($_POST['cpf']);
              $nome = $_POST['nome'];
              $login = $_POST['login'];
              $senha = md5($_POST['senha']);
              $departamento = intval($_POST['departamento']);
              if (!empty($_POST['admin'])) {
                $admin = intval($_POST['admin']);
              }else{
                $admin = 0;
              }

              //dados salvar tabela endereço
              $CEP = limpaCaracter($_POST['cep']);
              $numero = intval($_POST['numero']);
              $complemento = $_POST['complemento'];
              $referencia = $_POST['referencia'];

              //  var_dump($CPF, $nome, $login, $senha, $admin, $CEP,  $numero,  $complemento,  $referencia );
              //  die;
              include 'conexao.php';

              $sqlE = "INSERT INTO enderecos (cep, numero, complemento, ponto_referencia)
                      VALUES ('$CEP', '$numero', '$complemento', '$referencia');";
              $resultadoE = mysqli_query($conexao, $sqlE);

              $endereco_id = mysqli_insert_id($conexao);
              // var_dump($endereco_id); die;
              if ($resultadoE) {
                $sqlP = "INSERT INTO pessoas (cpf, nome, login, senha, administrador, departamento_id, endereco_id)
                        VALUES ('$CPF', '$nome', '$login', '$senha', '$admin', '$departamento', '$endereco_id');";
                $resultado = mysqli_query($conexao, $sqlP);
              }

              if (!$resultado) {
                if (mysql_errno() == 1062) {
                    header('location:cadastro_usuario.php?error=1062');
                }else{
                  header('location:cadastro_usuario.php?error=1');
                }

              }else{
                header('location:cadastro_usuario.php?sucess=1');
              }
        }else{
          header('location:cadastro_usuario.php?error=2');
        }
      }
      if (!empty($_GET['error'])) {
          $error = $_GET['error'];

          if ($error == 1) {
              echo "<p class=\"text-warning\">Cadastro Não Efetuado.</p>";

          }else if ($error == 1062) {
            echo "<p class=\"text-warning\">Já existe um cadastro com esses dados.</p>";
          }

      }else if (!empty($_GET['sucess'])) {
        $sucess = $_GET['sucess'];
        if ($sucess == 1) {
          echo "<p class=\"text-warning\">Cadastro Efetuado.</p>";
        }
      }

    ?>
    <h2 class="text-info">Cadastrar Usuário</h2>
    <form name="cadastroUsuario" action="" method="post" onSubmit="return validar_cadastroUsuario()">
      <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control cpf-field" id="cpf" name="cpf" placeholder="CPF">
      </div>

      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
      </div>
      <div class="form-group">
        <label for="departamento">Departamento:</label>
        <?php
            include 'conexao.php';
            $sql = "SELECT * FROM departamentos";
            $resultado = mysqli_query($conexao, $sql);
            $rows = mysqli_fetch_all($resultado);

            if (count($rows) > 0) {
        ?>
        <select name="departamento" id="departamento" class="form-control">
            <?php

            for ($i=0; $i < count($rows); $i++) {
                $id_dep = $rows[$i][0];
                $nome_dep = $rows[$i][1];
                echo "<option value=\"$id_dep\">$nome_dep</option>";
            }

            ?>
        </select>
        <?php
            } else {
                echo "<p class=\"bg-warning\"><p>Você deve cadastrar ao menos um autor.</p></p>";
            }
        ?>
      </div>
      <div class="form-endereco">
        <div class="form-group">
          <label for="cep">CEP:</label>
          <input type="text" class="form-control cep-field" id="cep" name="cep" placeholder="CEP">
          <span class="help-block hide">CEP não encontrado.</span>
        </div>
        <div class="form-group">
          <label for="rua">Rua:</label>
          <input type="text" class="form-control" id="rua" name="rua" placeholder="Rua" readonly>
        </div>
        <div class="form-group">
          <label for="bairro">Bairro:</label>
          <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" readonly>
        </div>
        <div class="form-group">
          <label for="cidade">Cidade:</label>
          <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" readonly>
        </div>
        <div class="form-group">
          <label for="uf">UF:</label>
          <input type="text" class="form-control" id="uf" name="uf" placeholder="UF" readonly>
        </div>

        <div class="form-group">
          <label for="numero">Numero:</label>
          <input type="number" class="form-control" id="numero" name="numero" placeholder="Numero">
        </div>
        <div class="form-group">
          <label for="complemento">Complemento:</label>
          <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento">
        </div>
        <div class="form-group">
          <label for="referencia">Ponto Referencia:</label>
          <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Ponto Referencia">
        </div>
      </div>

      <div class="form-login">
        <div class="form-group">
          <label for="login">Login:</label>
          <input type="text" class="form-control" id="login" name="login" placeholder="Login">
          <span class="help-block hide">O login deve conter 4 dígitos ou mais.</span>
        </div>
        <div class="form-group">
          <label for="senha">Senha:</label>
          <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
          <span class="help-block hide">A senha deve conter 6 dígitos ou mais.</span>
        </div>
        <div class="form-group">
          <label for="senhaConf">Confirmar Senha:</label>
          <input type="password" class="form-control" id="senhaConf" name="senhaConf" placeholder="Confirmar Senha">
        </div>
      </div>





      <div class="form-group">
        <label for="admin"><input type="checkbox" class="form-control" id="admin" name="admin"> Administrador</label>
      </div>

      <button class="btn btn-primary" type="submit" name="cadastrarUsuario">Cadastrar</button>
    </form>

    <script language="javascript" type="text/javascript">
// ----------------------------- Validar CPF ---------------------------------
      function validaCpf(str){
          str = str.replace('.','');
          str = str.replace('.','');
          str = str.replace('-','');

          cpf = str;
          var numeros, digitos, soma, i, resultado, digitos_iguais;
          digitos_iguais = 1;
          if (cpf.length < 11)
              return false;
          for (i = 0; i < cpf.length - 1; i++)
              if (cpf.charAt(i) != cpf.charAt(i + 1)){
                  digitos_iguais = 0;
                  break;
              }
          if (!digitos_iguais){
              numeros = cpf.substring(0,9);
              digitos = cpf.substring(9);
              soma = 0;
              for (i = 10; i > 1; i--)
                  soma += numeros.charAt(10 - i) * i;
              resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
              if (resultado != digitos.charAt(0))
                  return false;
              numeros = cpf.substring(0,10);
              soma = 0;
              for (i = 11; i > 1; i--)
                  soma += numeros.charAt(11 - i) * i;
              resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
              if (resultado != digitos.charAt(1))
                  return false;
              return true;
          }
          else
              return false;
      }
// ----------------------------- Validações ON BLUR ---------------------------------
    // ----------------------------- Validar CEP ---------------------------------
      function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...")
                        $("#bairro").val("...")
                        $("#cidade").val("...")
                        $("#uf").val("...")
                        $("#ibge").val("...")

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);

                                $('#cep').parent().removeClass('has-error');
                                $('#cep').parent().find('.help-block').addClass('hide');
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                $('#cep').parent().addClass('has-error');
                                $('#cep').parent().find('.help-block').removeClass('hide');
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        $('#cep').parent().addClass('has-error');
                        $('#cep').parent().find('.help-block').removeClass('hide');;
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                    $('#cep').parent().removeClass('has-error');
                    $('#cep').parent().find('.help-block').addClass('hide');
                }
            });
    // ----------------------------- Validação Senha ---------------------------------
            $('#senha').blur(function(){
              var senha = $(this).val();
              if (senha != '') {
                if (senha.length < 6) {
                    $(this).parent().addClass('has-error');
                    $(this).parent().find('.help-block').removeClass('hide');
                }else{
                  $(this).parent().removeClass('has-error');
                  $(this).parent().find('.help-block').addClass('hide');
                }
              }
            });

            $('#login').blur(function(){
              var login = $(this).val();
              if (login != '') {
                if (login.length < 4) {
                    $(this).parent().addClass('has-error');
                    $(this).parent().find('.help-block').removeClass('hide');
                }else{
                  $(this).parent().removeClass('has-error');
                  $(this).parent().find('.help-block').addClass('hide');
                }
              }
            });

// ----------------------------- Validação on Submit  ---------------------------------
      function validar_cadastroUsuario() {
        var cpf = cadastrarUsuario.cpf.value;

        var nome = cadastrarUsuario.nome.value;
        var login = cadastrarUsuario.login.value;
        var senha = cadastrarUsuario.senha.value;
        var senhaConf = cadastrarUsuario.senhaConf.value;
        var admin = cadastrarUsuario.admin.value;
        var departamento = cadastrarUsuario.departamento.value;

        var cep = cadastrarUsuario.cep.value;
        var numero = cadastrarUsuario.numero.value;

        if (cpf == '' || nome == '' || login == ''|| senha == ''|| senhaConf == '' || departamento == '' || cep == '' || numero == '' ) {
          sweetAlert("Oops...", "Preencha todos os campos.", "error");
          return false;
        }else if(senha != senhaConf){
          sweetAlert("Oops...", "Os campos de Senha precisam ser iguais.", "error");
          return false;
        }else if(senha.length < 6){
          sweetAlert("Oops...", "Senha deve conter 6 dígitos ou mais.", "error");
          return false;
        }else if(login.length < 4){
          sweetAlert("Oops...", "Login deve conter 4 dígitos ou mais.", "error");
          return false;
        }else if(!validaCpf(cpf)){
          sweetAlert("Oops...", "CPF inválido.", "error");
          return false;
        }else{
          return true;
        }
      }
    </script>
  </div>
</main>
<?php include 'footer.php'; ?>