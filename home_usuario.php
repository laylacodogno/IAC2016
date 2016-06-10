<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<main>
  <div class="container">
    <h1>Seja bem vindo, <?php  echo $_SESSION['nome'] ?> </h1>
    <div class="container">
      <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
      <a href="seleciona_tag.php">Relatórios</a>
    </div>
  </div>
</main>
<?php include 'footer.php'; ?>
