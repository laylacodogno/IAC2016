<?php include 'header.php'; ?>
    <main>
      <div class="container">
        <div class="page-header">
          <h1>Cadastro TAG</h1>
        </div>

        <div class="panel panel-default">
          <div class="panel-body">
            <form action="">

              <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="number" class="form-control" id="cpf" placeholder="CPF">
              </div>
              <div class="form-group">
                <label for="departamento">TAG</label>
                <input type="number" class="form-control" id="tag" placeholder="Tag">
              </div>
              <div class="form-group">
                <label for="departamento">TAG Master</label>
                <input type="number" class="form-control" id="tag" placeholder="Tag Master">
              </div>
              <button type="submit" class="btn btn-default">Cadastrar</button>
            </form>
          </div>
        </div>
      </div>

    </main>

<?php include 'footer.php'; ?>
