<?php include 'header.php'; ?>
    <main>
      <div class="container">
        <div class="page-header">
          <h1>Entradas</h1>
        </div>

        <div class="panel panel-default">
          <div class="panel-body">
            <form action="">
              <div class="form-group">
                <label for="tag-number">TAG</label>
                <input type="number" class="form-control" id="tag-number" placeholder="TAG">
              </div>
              <button type="submit" class="btn btn-default">Pesquisar</button>
            </form>
          </div>
        </div>
        <div class="list">
          <table class="table table-striped">
            <thead>
              <tr>

                <th>
                  tag
                </th>
                <th>
                  cpf
                </th>
                <th>
                  ações
                </th>
              </tr>

            </thead>
            <tbody>
              <tr>

                <td>
                  0999199
                </td>
                <td>
                  092.660.269-16
                </td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Ações <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a href="#">Editar</a></li>
                      <li><a href="#">Excluir</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#">Configurações</a></li>
                    </ul>
                  </div>

                </td>
              </tr>
              <tr>

                <td>
                  0999195
                </td>
                <td>
                  042.650.239-16
                </td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Ações <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a href="#">Editar</a></li>
                      <li><a href="#">Excluir</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#">Configurações</a></li>
                    </ul>
                  </div>

                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </main>

<?php include 'footer.php'; ?>
