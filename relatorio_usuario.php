<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php include 'authenticate.php';
if((!$login) || ($admin)){ ?>
  <div class="container alert alert-danger">
    <h2>Você não tem permissão para acessar essa página, por favor faça login no sistema.</h2>
  </div>
<?php  die;
}
  $usuario = $_SESSION['usuario'];
  $sqlP = "SELECT * FROM pessoas
  WHERE login = '$usuario';";
  include 'conexao.php';
  $resultadoP = mysqli_query($conexao, $sqlP);
  $row = mysqli_fetch_row($resultadoP);
  $id_usuario = $row[0];
  $sqlTP = "SELECT id FROM tags
  WHERE pessoa_id = '$id_usuario';";
  $resultadoTP = mysqli_query($conexao, $sqlTP);
  $qtdtag = mysqli_num_rows($resultadoTP);
  if ($qtdtag > 0) {
    $x=0;
    while($row = mysqli_fetch_assoc($resultadoTP)) {
      $tags[$x] = $row["id"];
      $x++;
    }
  }
?>
<main>
  <div class="container">
    <form class="" action="relatorio_usuario.php" method="post">
      <h2>Selecione a TAG que deseja buscar</h2>
      <div class="form-group">
      <select name="tag" id="tag" class="form-control">
        <option value="0"> Selecione a tag...</option>;
    <?php
    for ($i=0; $i < $qtdtag; $i++) {
        echo "<option value=\"$tags[$i]\">$tags[$i]</option>";
    }

    ?>
      </select>
    </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit" name="procurarTag">Buscar</button>
      </div>
    </form>
    <?php if (isset($_POST['tag'])){
      if($_POST['tag'] != 0){
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
      }?>
      <h2 class="text-info">TAG: <?php echo $_POST['tag'] ?></h2>
          <table class="table sortable">
            <tr>
              <th>DATA &nbsp</th>
              <th>HORÁRIO &nbsp</th>
            </tr>
            <?php for ($i=0; $i < $qtdEntradas; $i++) {
              $datahora = explode(" ",$entradas[$i]);
              $data=date('d/m/Y', strtotime($entradas[$i]));
              ?>
            <tr>
              <td> <?php echo $data; ?> &nbsp</td>
              <td> <?php echo $datahora[1] ?> &nbsp</td>
            </tr>
            <?php } ?>
          </table>
    <?php }
  } ?>
  </div>
</main>
<?php include 'footer.php'; ?>
