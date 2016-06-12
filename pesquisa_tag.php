<?php include 'header.php' ?>
<?php include 'nav.php' ?>


<main>
  <div class="container">
    <?php include 'authenticate.php';
    if(!$admin){ ?>
      <div class="alert alert-danger">
        <h2>Você não tem permissão para acessar essa página, por favor faça login no sistema.</h2>
      </div>
    <?php  die;
    }?>

  <h1 class="text-info">Consulta de TAG</h1>


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

    <h3> <?php echo "O usuário " .$nome_usuario ." possui " .$qtdtag ." tags"?></h4>


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

  <?php }?>

  <?php if(isset($_POST['tag'])){
    if(!empty($_POST['tag'])){
      include 'conexao.php';
      $tag = $_POST['tag'];
      $sqlTG = "SELECT * FROM tags WHERE id='$tag'";
      $resultTG = mysqli_query($conexao, $sqlTG);
      $row2 = mysqli_fetch_row($resultTG);
      $id_pessoa = $row2[1];
      $sqlDD = "SELECT * FROM pessoas WHERE id='$id_pessoa';";
      $resultDD = mysqli_query($conexao, $sqlDD);
      $row3 = mysqli_fetch_row($resultDD);
      $nomep = $row3[1];
      $loginp = $row3[3];
      $cpfp = $row3[5];
      $depid = $row3[6];
      $endid = $row3[7];
      $sqlDE = "SELECT * FROM departamentos WHERE id='$depid';";
      $resultDE = mysqli_query($conexao, $sqlDE);
      $row4 = mysqli_fetch_row($resultDE);
      $depp = $row4[1];
      $sqlEN = "SELECT * FROM enderecos WHERE id='$endid';";
      $resultEN = mysqli_query($conexao, $sqlEN);
      $row5 = mysqli_fetch_row($resultEN);
      $cepp = $row5[1];
      $nmrp = $row5[2];
      $comp = $row5[3];
    } ?>

      <table class="table-striped table table-bordered">
        <tr>
          <th>NOME &nbsp</th>
          <th>CPF &nbsp</th>
          <th>LOGIN &nbsp</th>
          <th>DEPARTAMENTO &nbsp</th>
          <th>CEP &nbsp</th>
          <th>NÚMERO &nbsp</th>
          <th>COMPLEMENTO &nbsp</th>
        </tr>
        <tr>
          <td> <?php echo $nomep ?> &nbsp</td>
          <td> <?php echo $cpfp ?> &nbsp</td>
          <td> <?php echo $loginp ?> &nbsp</td>
          <td> <?php echo $depp ?> &nbsp</td>
          <td> <?php echo $cepp ?> &nbsp</td>
          <td> <?php echo $nmrp ?> &nbsp</td>
          <td> <?php echo $comp ?> &nbsp</td>
        </tr>
      </table>

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
