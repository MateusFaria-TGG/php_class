<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . 'Aula06/DAO/usuariosDAO.php');
	echo $_POST['f_mail'];
	echo $_POST['f_senha'];
	echo $_POST['f_nome'];
	echo $_POST['f_perfil'];
	echo $_POST['f_id'];

	if(isset($_POST['f_mail']) and isset($_POST['f_senha']) and isset($_POST['f_nome']) and isset($_POST['f_perfil']) and isset($_POST['f_id'])){
		$myuser = new usuarios();
		$myuser->setNome($_POST['f_nome']);
		$myuser->setEmail($_POST['f_mail']);
		$myuser->setId($_POST['f_id']);
		$myuser->setId_perfis(intval($_POST['f_perfil']));
		$myuser->setSenha($_POST['f_senha']);

		$myuserDAO = new usuariosDAO($myuser);
		$myuserDAO->update($_POST['f_id']);
	}

	Header( "Location: cadastro.php" );
?>
