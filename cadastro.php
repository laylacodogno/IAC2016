<?php include 'header.php'; ?>
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
                <label for="departamento">Departamento</label>
                <input type="text" class="form-control" id="departamento" placeholder="Departamento">
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
