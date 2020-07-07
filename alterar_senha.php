<?php
  require_once($_SERVER['DOCUMENT_ROOT'] . 'Aula06/classes/usuarios.php');
  require_once($_SERVER['DOCUMENT_ROOT'] . 'Aula06/DAO/usuariosDAO.php');
  session_start();

  $myuser = new usuarios();
  $myuserdao = new usuariosDAO($myuser);
  $user = $_SESSION['usuario'];

  if(isset($_POST['f_senha']) and strlen($_POST['f_senha']) > 5){
    $user_find = $myuserdao->find($user);

    $myuser->setNome($user_find[0]->nome);
    $myuser->setEmail($user_find[0]->email);
    $myuser->setSenha(md5($_POST['f_senha']));
    $myuser->setId_perfis($user_find[0]->id_perfis);
    $myuserdao->update($user);

    Header("Location:index.php");
  }
?>

<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Sistema | alterar senha</title>
  </head>
  <body>
    <b align=center>
    <h1>Para usar o sistema, é necessário alterar a senha padrão! </h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <h2>Nova Senha:</h2>
      <input type="password" name="f_senha">
      <h3>Senha deve conter 6 caracteres no mínimo</h3>
      <button type="submit" name="button">Enviar</button>
    </form>
    </b>
  </body>
</html>
