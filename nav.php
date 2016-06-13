<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">
        IAC
      </a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <?php
          if(session_status() == PHP_SESSION_NONE) {
              session_start();
          }

          if (empty($_SESSION['usuario']) && empty($_SESSION['senha'])) {
              echo '<li><a href="cadastro_usuario.php">Cadastro</a></li>';
              echo '<li><a href="login.php">Login</a></li>';
          } else {
            if ($_SESSION['admin'] == "1" ){
              echo '<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="relatorio_admin.php">Relatórios</a></li>
                      <li><a href="alterar_usuario.php">Alterar Usuário</a></li>
                      <li><a href="aprovar_cadastro.php">Aprovar Usuário</a></li>
                      <li role="separator" class="divider"></li>

                      <li><a href="cadastro_tag.php">Cadastrar TAG</a></li>
                      <li><a href="pesquisa_tag.php">Pesquisar TAG</a></li>
                      <li><a href="alterar_tag.php">Alterar TAG</a></li>
                      <li><a href="entrada.php">Entrar TAG</a></li>
                    </ul>
                  </li>';
              echo '<li><a href="logout.php">Logout</a></li>';
            }else{
              echo '<li><a href="relatorio_usuario.php">Relatórios</a></li>';
              echo '<li><a href="logout.php">Logout</a></li>';
            }
          }

      ?>

    </ul>
  </div>
</nav>
