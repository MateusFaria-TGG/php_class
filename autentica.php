<?php
  require_once("DAO/usuariosDAO.php");
  session_start();
  if (isset($_POST['f_mail']) and isset($_POST['f_senha'])) {
    $myuser = new usuarios();

    $myuser->setEmail($_POST['f_mail']);

    if(isset($_POST['f_senha']) and $_POST['f_senha'] == '123456'){
      $myuser->setSenha($_POST['f_senha']);
    }else{
      $myuser->setSenha(md5($_POST['f_senha']));
    }

    $myuserdao = new usuariosDAO($myuser);
    $resultado = $myuserdao->login();

    if($resultado > 0){
      if($_POST['f_senha'] == '123456'){
        $_SESSION['usuario'] = $resultado;
        $pagina = "Location:alterar_senha.php";
      } else {
        $pagina = "Location:cadastro.php";
      }
    } else {
      $pagina = "Location:index.php?msg=falha";
    }
  } else {
    $pagina = "Location:index.php?msg=falha";
  }
  Header($pagina);
?>
