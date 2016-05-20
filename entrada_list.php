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
                  data e hora
                </th>
                <th>
                  tag
                </th>
                <th>
                  cpf
                </th>
              </tr>

            </thead>
            <tbody>
              <tr>
                <td>
                  06/05/2016 as 16:20
                </td>
                <td>
                  0999199
                </td>
                <td>
                  092.660.269-16
                </td>
              </tr>
              <tr>
                <td>
                  06/05/2016 as 16:25
                </td>
                <td>
                  0999195
                </td>
                <td>
                  042.650.239-16
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </main>

<?php include 'footer.php'; ?>
