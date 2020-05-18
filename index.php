<?php include "usuarios.php";
  session_start();
  $myuser = new usuarios();
  if(isset($_POST['f_email']) and isset($_POST['f_senha'])){
    $myuser->setEmail($_POST['f_email']);
    $myuser->setSenha(md5($_POST['f_senha']));
    $resultado = $myuser->login();
    if($resultado > 0){
      if($_POST['f_senha'] == '123456'){
        $_SESSION['usuario'] = $myuser->getId();
        Header("Location:alterar_senha.php");
      }
      else {
        Header("Location:cadastro.php");
      }
    } else {
      exibe_pagina('Login ou senha incorreto.');
    }
  } else {
    exibe_pagina('');
  }

  function exibe_pagina($mensagem){
    echo "<html><head><title>Login do sistema</title></head>";
    echo "<body><b>";
    echo "<p align='center'><img src'' ></p>";
    echo "<p>".$mensagem."</p>";
    echo "<div align='center'>";
    echo "<form method=POST action=$_SERVER[PHP_SELF]>";
    echo "<H2>Email: <input type=text name='f_email'></H2>";
    echo "<br/><h2>Senha: <input type=password name='f_senha'></h2><br/>";
    echo "<button>Enviar</button>";
    echo "</form></div></b></body>";
  }
?>
