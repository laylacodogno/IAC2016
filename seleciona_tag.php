<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php
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
    <form class="" action="relatorio.php" method="post">
      <h2>Selecione a TAG que deseja buscar</h2>
      <div class="form-group">
      <select name="tag" id="tag" class="form-control">
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
  </div>
</main>
<?php include 'footer.php'; ?>
