
<?php include 'header.php'; ?>
<?php
  if (!isset($_SESSION['id'])) {
    header('Location: login.php');
  }else{
    if (isset($_POST['cpf'])) {
      $erro = [];
      if (strlen($_POST['cpf']) != 11) {
        $erro[] = "CPF deve conter 11 dígitos"
      }
      #fazer validações
      if (empty($erro)) {
        msqli_query("insert into pessoas")
      }
    }
  }


?>
<script type="text/javascript">

</script>
    <main>
      <div class="container">
        <div class="page-header">
          <h1>Cadastro Cliente</h1>
          <p>
          <?php echo $_SESSION["nome"]; ?>
          </p>
        </div>

        <div class="panel panel-default">
          <div class="panel-body">
            <form action="">
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" placeholder="Nome">
              </div>
              <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="number" class="form-control" id="cpf" placeholder="CPF">
              </div>
              <div class="form-group">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Departamento
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  <li><span value="3">Operação</span></li>
                  <li><span value="4">Administração</span></li>
                  <li><span value="5">Outro</span></li>
                </ul>
              </div>
              <div class="form-group">
                <label for="cep">CEP</label>
                <input type="number" class="form-control" id="cep" placeholder="CEP">
              </div>
              <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="endereco" placeholder="Endereço">
              </div>
              <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="phone" class="form-control" id="telefone" placeholder="Telefone">
              </div>
              <button type="submit" class="btn btn-default">Cadastrar</button>
            </form>
          </div>
        </div>
      </div>

    </main>

<?php include 'footer.php'; ?>
