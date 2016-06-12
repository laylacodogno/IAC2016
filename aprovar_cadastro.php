<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<main>
  <div class="container">
    <?php include 'authenticate.php';
      if(!$admin){ ?>
        <div class="alert alert-danger">
          <h2>Você não tem permissão para acessar essa página, por favor faça login no sistema.</h2>
        </div>
      <?php  die;
      }

        include 'conexao.php';
        if(isset($_POST['aprovar'])){
          $idapp = $_POST['aprovar'];
          $sqlTR = "SELECT * FROM solicitacoes WHERE id='$idapp'";
          $resultTR = mysqli_query($conexao, $sqlTR);
          $rowpp = mysqli_fetch_row($resultTR);
          $nomi=$rowpp[1];
          $admi=$rowpp[2];
          $logi=$rowpp[3];
          $senh=$rowpp[4];
          $cpfi=$rowpp[5];
          $depi=$rowpp[6];
          $endi=$rowpp[7];
          $sqlDL = "DELETE FROM solicitacoes WHERE id='$idapp'";
          $resultDL = mysqli_query($conexao, $sqlDL);
          $sqlCD = "INSERT INTO pessoas(cpf, nome, login, senha, administrador, departamento_id, endereco_id)
                  VALUES ('$cpfi', '$nomi', '$logi', '$senh', '$admi', '$depi', '$endi');";
          $resultCD = mysqli_query($conexao, $sqlCD);
        }
        else if(isset($_POST['recusar'])){
          $idout = $_POST['recusar'];
          $sqlOUT = "DELETE FROM solicitacoes WHERE id='$idout'";
          $resultOUT = mysqli_query($conexao, $sqlOUT);
        }
        $sqlSO = "SELECT * FROM solicitacoes";
        $resultSO = mysqli_query($conexao, $sqlSO);
        $qtdsol = mysqli_num_rows($resultSO);
        if ($qtdsol > 0) {
          $x=0;
          while($row = mysqli_fetch_assoc($resultSO)) {
            $nmr[$x] = $row["id"];
            $nome[$x] = $row["nome"];
            $loggin[$x] = $row["login"];
            $x++;
          }
        }
      ?>

        <h1>Solicitações de Cadastro</h1>
        <table class="table table-bordered sortable">
          <tr>
            <th>Nome</th>
            <th>Login</th>
            <th>Ação</th>
          </tr>
          <?php for ($i=1; $i <= $qtdsol; $i++) {
            $idshow = $nmr[($i-1)]?>
            <tr>
              <td> <?php echo $nome[($i-1)] ?></td>
              <td> <?php echo $loggin[($i-1)] ?></td>
              <td> <form action="aprovar_cadastro.php" method="post"> <button class="btn btn-danger" type="submit" value="<?php echo $idshow ?>" name="recusar">Recusar</button> &nbsp<button class="btn btn-success" type="submit" value="<?php echo $idshow ?>" name="aprovar">Aprovar</button></form></td>
            </tr>
          <?php } ?>
        </table>
  </div>

</main>
<?php include 'footer.php'; ?>
