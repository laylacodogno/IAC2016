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
              echo '<li><a href="aprovar_cadastro.php">Aprovar Usuários</a></li>';
              echo '<li><a href="cadastro_tag.php">Cadastrar TAG</a></li>';
              echo '<li><a href="logout.php">Logout</a></li>';
            }else{
              echo '<li><a href="logout.php">Logout</a></li>';
            }
          }

      ?>
    </ul>
  </div>
</nav>
