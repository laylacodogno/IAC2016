<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>


<main>
  <div class="container">
    <?php include 'authenticate.php';
    if((!$login) || ($admin)){ ?>
      <div class="alert alert-danger">
        <h2>Você não tem permissão para acessar essa página, por favor faça login no sistema.</h2>
      </div>
    <?php  die;
    }?>
    <h1>Seja bem vindo, <?php  echo $_SESSION['nome'] ?> </h1>
    <div class="menu-user">
      <a class="menu-option" href="relatorio_usuario.php" >
          <span class="glyphicon glyphicon-search gi-100"></span>
          <span class="option-name">Relatórios</span>
      </a>
    </div>

  </div>
</main>
