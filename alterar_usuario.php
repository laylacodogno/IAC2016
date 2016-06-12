<?php include 'header.php' ?>
<?php include 'nav.php' ?>
<?php include 'authenticate.php';
if(!$admin){ ?>
  <div class="container alert alert-danger">
    <h2>Você não tem permissão para acessar essa página, por favor faça login no sistema.</h2>
  </div>
<?php  die;
}?>

<?php
  if (isset($_POST['usuario'])) {
    if (!empty($_POST['usuario'])) {
      $cpf=limpaCaracter($_POST['usuario']);
      include 'conexao.php';
      $sqlU = "SELECT * FROM pessoas WHERE cpf = '$cpf'";
      $resultadoU = mysqli_query($conexao, $sqlU);
      $rowU = mysqli_fetch_row($resultadoU);
      $idUser = $rowU[0];
      $nome = $rowU[1];
      $dep = $rowU[6];
      $end = $rowU[7];
      $sqlEnd = "SELECT * FROM enderecos WHERE id = '$end';";
      $resultadoEnd = mysqli_query($conexao, $sqlEnd);
      $rowEnd = mysqli_fetch_row($resultadoEnd);
      $cep = $rowEnd[1];
      $numero = $rowEnd[2];
      $compl = $rowEnd[3];
      $ptRef = $rowEnd[4];
    }
  }
  if (isset($_POST['salvar'])) {
      $update[0] = limpaCaracter($_POST['usuario']);
      $update[1] = $_POST['nome'];
      $update[2] = $_POST['departamento'];
      $update[3] = limpaCaracter($_POST['cep']);
      $update[4] = $_POST['numero'];
      $update[5] = $_POST['complemento'];
      $update[6] = $_POST['referencia'];
      $descr[0] = 'cpf';
      $descr[1] = 'nome';
      $descr[2] = 'departamento_id';
      $descr[3] = 'endereco_id';

      $sqlB = "SELECT * FROM enderecos WHERE cep = '$update[3]' and numero = '$update[4]' and complemento = '$update[5]';";
      $resultadoB = mysqli_query($conexao, $sqlB);
      if (mysqli_num_rows($resultadoB) >= 1){
        $row = mysqli_fetch_row($resultadoB);
        $endereco_id = $row[0];
      }
      else{
        $sqlEnd = "INSERT INTO enderecos(cep, numero, complemento, ponto_referencia)
        VALUES ('$update[3]','$update[4]','$update[5]','$update[6]')";
        $resultadoEnd = mysqli_query($conexao, $sqlEnd);
        $endereco_id = mysqli_insert_id($conexao);
      }

      $sqlUp = "UPDATE pessoas SET endereco_id = '$endereco_id' WHERE id = $idUser;";
      $resultadoUp = mysqli_query($conexao, $sqlUp);

      for ($i=0; $i < 3; $i++) {
      $sqlUp = "UPDATE pessoas SET $descr[$i] = '$update[$i]' WHERE id = $idUser;";
      $resultadoUp = mysqli_query($conexao, $sqlUp);
      }

    }
?>

<main>
  <div class="container">
    <h1>Alterar Usuário</h1>
    <form name="editar" id="editar" action="alterar_usuario.php" method="post">
      <div class="form-group">
        <label for="usuario">Digite o CPF do Usuário:</label>
        <input type="text" class="form-control cpf-field" name="usuario" value="<?php if(isset($_POST['usuario']))
        echo $cpf ?> ">
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit" name="">Editar</button>
      </div>
    </form>

    <?php if (isset($_POST['usuario'])): ?>
      <h2>Editar</h2>
      <form class="" name="editar" action="alterar_usuario.php" method="post">
          <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control cpf-field" name="usuario" value="<?php echo $cpf ?>">
          </div>

          <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo $nome ?>">
          </div>

          <div class="form-group">
            <label for="departamento">Departamento:</label>
            <?php
                $sqlDep = "SELECT * FROM departamentos";
                $resultadoDep = mysqli_query($conexao, $sqlDep);
                $rowsD = mysqli_fetch_all($resultadoDep);
            ?>
            <select name="departamento" id="departamento" class="form-control">
              <?php
              for ($i=0; $i < count($rowsD); $i++) {
                  $id_dep = $rowsD[$i][0];
                  $nome_dep = $rowsD[$i][1];
                  echo "<option value=\"$id_dep\"";
                  if ($dep == $id_dep) {
                    echo"selected";
                  }
                  echo ">$nome_dep</option>";
              }?>
            </select>

          </div>
          <div class="form-endereco">
            <div class="form-group">
              <label for="cep">CEP:</label>
              <input type="text" class="form-control cep-field" id="cep" name="cep" placeholder="CEP" value="<?php echo $cep ?>">
              <span class="help-block hide">CEP não encontrado.</span>
            </div>

            <div class="form-group">
              <label for="rua">Rua:</label>
              <input type="text" class="form-control" id="rua" name="rua" placeholder="Rua" readonly>
            </div>
            <div class="form-group">
              <label for="bairro">Bairro:</label>
              <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" readonly>
            </div>
            <div class="form-group">
              <label for="cidade">Cidade:</label>
              <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" readonly>
            </div>
            <div class="form-group">
              <label for="uf">UF:</label>
              <input type="text" class="form-control" id="uf" name="uf" placeholder="UF" readonly>
            </div>

            <div class="form-group">
              <label for="numero">Numero:</label>
              <input type="number" class="form-control" id="numero" name="numero" placeholder="Numero" value="<?php echo $numero ?>">
            </div>
            <div class="form-group">
              <label for="complemento">Complemento:</label>
              <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento" value="<?php echo $compl ?>">
            </div>
            <div class="form-group">
              <label for="referencia">Ponto Referencia:</label>
              <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Ponto Referencia" value="<?php echo $ptRef ?>">
            </div>
          </div>
          <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
      </form>
    <?php endif; ?>
  </div>
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
