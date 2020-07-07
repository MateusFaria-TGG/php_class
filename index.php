<?php
  session_start();
  $_SESSION = array();
  session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <b>
      <?php
        if (isset($_GET['msg'])){
          echo '<p align=center> Falha na autenticação </p>';
        }
      ?>

      <div align='center'>
        <form action="autentica.php" method="post">
          <h2>Email: <input type=email name="f_mail"/></h2>
          <br>
          <h2>Senha: <input type=password name="f_senha"/></h2>
          <br>
          <button>Enviar</button>
        </form>
      </div>
    </b>
  </body>
</html>
