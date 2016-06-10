<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<main>
  <div class="container">
    <h1>Relatórios de entrada</h1>
    <h2 class="text-info">TAG: <?php echo $_POST['tag'] ?></h2>
    <?php
      if (isset($_SESSION['usuario'])) {
        if (isset($_POST['tag'])){
          include 'conexao.php';
          $tag_id=$_POST['tag'];
          $sqlBE = "SELECT data FROM entradas
          WHERE tag_id = '$tag_id';" ;
          $resultadoBE = mysqli_query($conexao, $sqlBE);
          $qtdEntradas = mysqli_num_rows($resultadoBE);
          if ($qtdEntradas > 0) {
            $x=0;
            while ($row = mysqli_fetch_assoc($resultadoBE)) {
              $entradas[$x]=$row["data"];
              $x++;
          }
        }
      }
    }
    ?>
    <table class="table-striped table">
      <tr>
        <th>DATA &nbsp</th>
        <th>HORÁRIO &nbsp</th>
      </tr>
      <?php for ($i=0; $i < $qtdEntradas; $i++) {
        $datahora = explode(" ",$entradas[$i]);
        $data=date('d/m/Y', strtotime($entradas[0]));
        ?>
      <tr>
        <td> <?php echo $data; ?> &nbsp</td>
        <td> <?php echo $datahora[1] ?> &nbsp</td>
      </tr>
      <?php } ?>
    </table>
  </div>
</main>
<?php include 'footer.php'; ?>
