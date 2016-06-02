<?php
 include("functions.php");
 connect();

 if(isset($_POST['login'])){
   if (!empty($_POST['login']) && !empty($_POST['password']) ) {
     $senha_hash = md5($_POST['password']);

     $query_login = mysqli_query($connect, "SELECT * FROM pessoas WHERE login = '".$_POST['login']."' and senha = '".$senha_hash."'");
     $rows = mysqli_fetch_all($query_login);
     if (count($rows) > 0) {

       $_SESSION['id'] = $rows[0]['id'];
       $_SESSION['nome'] = $rows[0]['nome'];

       header('Location: cadastro.php');
       exit;
     }else{
       $erro = 'Login ou Senha inválidos';
     }

   }else{
     $erro = 'Login ou Senha não podem ser vazio.';
   }
 }


?>
<?php include 'header.php'; ?>
    <main>
      <div class="container">
        <div class="page-header">
          <h1>Login</h1>
        </div>
        <?php if (!empty($erro)):
          echo $erro;
       endif; ?>

        <div class="panel panel-default">
          <div class="panel-body">
            <form action="" method="POST">
              <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Login">
              </div>
              <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
              </div>
              <button type="submit" class="btn btn-default">Entrar</button>
            </form>
          </div>
        </div>
      </div>

    </main>

<?php include 'footer.php'; ?>
