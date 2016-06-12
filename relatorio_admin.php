<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php include 'authenticate.php';
if(!$admin){ ?>
  <div class="container alert alert-danger">
    <h2>Você não tem permissão para acessar essa página, por favor faça login no sistema.</h2>
  </div>
<?php  die;
}?>

<main>
  <div class="container">
    <h1>Relatórios de entrada</h1>
    <form class="" action="relatorio_admin.php" method="post">
      <div class="form-group">
        <label for="pesquisa">CPF:</label>
        <input class="form-control cpf-field" type="text" id="pesquisa" name="pesquisa" placeholder="CPF">
      </div>
      <button class="btn btn-primary" type="submit" name="procurarTag">Buscar</button>
    </form>
    <div class=""><br>
        <?php
        if (isset($_SESSION)) {
          if (isset($_POST['pesquisa'])) {
            if (!empty($_POST['pesquisa'])) {

              function limpaCaracter($valor){
               $valor = trim($valor);
               $valor = str_replace(".", "", $valor);
               $valor = str_replace(",", "", $valor);
               $valor = str_replace("-", "", $valor);
               $valor = str_replace("/", "", $valor);
               return $valor;
              }

              include 'conexao.php';
              $cpf = limpaCaracter($_POST['pesquisa']);
              $sqlP = "SELECT * FROM pessoas WHERE cpf = '$cpf';";
              $resultadoP = mysqli_query($conexao, $sqlP);
              $rowP = mysqli_fetch_row($resultadoP);
              $idUser = $rowP[0];
              $nameUser = $rowP[1];
              $sqlT = "SELECT * FROM tags WHERE pessoa_id = $idUser";
              $resultadoT = mysqli_query($conexao, $sqlT);
              $numTags = mysqli_num_rows($resultadoT);
              if ($numTags > 0) {
                $i=0;
                while($rowT = mysqli_fetch_assoc($resultadoT)) {
                  $tags[$i] = $rowT['id'];
                  $i++;
                }
              }?>
              <h2> Usuário <?php echo $nameUser; ?> </h2>
              <h4>Número de TAGs: <?php echo $numTags ?></h4>
              <table id="ordem" class="table table-striped table-bordered sortable">
                <tr> <th>TAG </th> <th>DATA </th> <th>HORÁRIO </th> </tr>
                <?php
              for ($x=0; $x < $numTags; $x++) {
                $sqlE = "SELECT * FROM entradas WHERE tag_id = $tags[$x];";
                $resultadoE = mysqli_query($conexao, $sqlE);
                $numEntr = mysqli_num_rows($resultadoE);
                if ($numEntr > 0) {
                  $k = 0;
                  while ($rowE = mysqli_fetch_assoc($resultadoE)) {
                    $entradas[$k] = $rowE['data'];
                    $k++;
                  }
                }
                if ($numTags!=0 || $numEntr!=0) {
                    for ($i=0; $i < $numEntr; $i++) {
                      $datahora = explode(" ",$entradas[$i]);
                      $data=date('d/m/Y', strtotime($entradas[$i]));
                      ?>
                    <tr>
                      <td> <?php echo $tags[$x]; ?> </td>
                      <td> <?php echo $data; ?> </td>
                      <td> <?php echo $datahora[1]; ?> </td>
                    </tr>
                    <?php
                    }
                }else {
                  echo "Nada para mostrar!";
                }
              }
            }
          }
        }
        ?>
      </table>
    </div>
  </div>
</main>
