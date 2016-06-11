<?php include 'header.php' ?>
<?php include 'nav.php' ?>
<style media="screen">
  .center{
    text-align: center;
  }
</style>
<main>
  <div class="container">
  <h1>Consulta de TAG:</h1>
  <br>
  <br>
  </div>
  <div class="container">
    <form class="form-inline col-sm-6" action="pesquisa_tag.php" method="post">
      <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control cpf-field" id="cpf" name="cpf" placeholder="CPF">
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit" name="consultaCPF">Consultar</button>
      </div>
    </form>
    <div class="form-group">
      <form class="form-inline col-sm-6" action="pesquisa_tag.php" method="post">
        <div class="form-group">
          <label for="tag">TAG:</label>
          <input type="number" class="form-control" id="tag" name="tag" placeholder="TAG">
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit" name="consultaTAG">Consultar</button>
        </div>
      </form>
    </div>
  </div>
  <?php if (isset($_POST['cpf'])){
    if ($_POST['cpf'] != ""){
      $cpf=limpaCaracter($_POST['cpf']);
      include 'conexao.php';
      $sqlID = "SELECT * FROM pessoas WHERE cpf='$cpf'";
      $resultID = mysqli_query($conexao,$sqlID);
      $row = mysqli_fetch_row($resultID);
      $id_usuario = $row[0];
      $nome_usuario = $row[1];
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
    } ?>
  <br>
  <div class="container center">
    <h3> <?php echo "O usuário " .$nome_usuario ." possui " .$qtdtag ." tags"?></h4>
  </div>
  <br>
  <div class="container center">
    <table class="table-striped table table-bordered">
      <tr>
        <th>TAG &nbsp</th>
        <th>Número &nbsp</th>
      </tr>
      <?php for ($i=0; $i < $qtdtag; $i++) { ?>
        <tr>
          <td> <?php echo ($i+1) ?> &nbsp</td>
          <td> <?php echo $tags[$i] ?> &nbsp</td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <?php }?>

  <?php if(isset($_POST['tag'])){
    if(!empty($_POST['tag'])){
      include 'conexao.php';
      $tag = $_POST['tag'];
      $sqlTG = "SELECT * FROM tags WHERE id='$tag'";
      $resultTG = mysqli_query($conexao, $sqlTG);
      $row2 = mysqli_fetch_row($resultTG);
      $id_pessoa = $row2[1];
      $sqlDD = "SELECT * FROM pessoas WHERE id='$id_pessoa'";
      $resultDD = mysqli_query($conexao, $sqlDD);
      $row3 = mysqli_fetch_row($resultDD);
      $cpfp = $row3[5];
      $nomep = $row3[1];
    } ?>
    <br>
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4 center">
      <table class="table-striped table table-bordered">
        <tr>
          <th>NOME &nbsp</th>
          <th>CPF &nbsp</th>
        </tr>
        <tr>
          <td> <?php echo $nomep ?> &nbsp</td>
          <td> <?php echo $cpfp ?> &nbsp</td>
        </tr>
      </table>
    </div>
  <?php } ?>
</main>
<?php function limpaCaracter($valor){
 $valor = trim($valor);
 $valor = str_replace(".", "", $valor);
 $valor = str_replace(",", "", $valor);
 $valor = str_replace("-", "", $valor);
 $valor = str_replace("/", "", $valor);
 return $valor;
} ?>
<?php include 'footer.php' ?>
