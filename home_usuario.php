<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<style media="screen">
  .gi-100{font-size: 6em;}
  .carbonad {
    width: auto ;
    height: auto ;
    padding: 1.25rem ;
    margin: 0px, auto; ;
    margin-top: 40px;
    text-align: center;
    border: 0 }
  a {
    text-decoration: none;
  }
</style>
<main>
  <div class="container">
    <h1>Seja bem vindo, <?php  echo $_SESSION['nome'] ?> </h1>
    <a href="relatorio.php" >
    <div class="carbonad col-md-offset-5 col-md-2" >
        <span class="glyphicon glyphicon-search gi-100"></span>
        <h3>Relatórios</h3>
    </div>
    </a>
  </div>
</main>
