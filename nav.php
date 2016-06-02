<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">
        IAC
      </a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <?php
          if(!isset($_SESSION)) {
              session_start();
          }

          if (empty($_SESSION['usuario']) && empty($_SESSION['senha'])) {
              echo '<li><a href="entrada.php">Entrada</a></li>';
              echo '<li><a href="login.php">Login</a></li>';
          } else {
              echo '<li><a href="cadastro_usuario.php">Cadastrar Usuário</a></li>';
              echo '<li><a href="cadastro_tag.php">Cadastrar TAG</a></li>';
              echo '<li><a href="logout.php">Logout</a></li>';
          }

      ?>
    </ul>
  </div>
</nav>
