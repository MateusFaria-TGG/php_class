<?php
	include ($_SERVER['DOCUMENT_ROOT'] . 'Aula06/classes/usuarios.php');
	include ($_SERVER['DOCUMENT_ROOT'] . 'Aula06/classes/perfis.php');
	include ($_SERVER['DOCUMENT_ROOT'] . 'Aula06/DAO/usuariosDAO.php');
	include ($_SERVER['DOCUMENT_ROOT'] . 'Aula06/DAO/perfisDAO.php');
?>
<html>
	<head>
		<title>Cadastro de Usuários</title>
	</head>
	<body>
		<b>
		<h1>Cadastro de Usuários</h1>
		<h1>Todos os campos são obrigatórios!</h1>
		<?php
			$myuser = new usuarios();
			$perfis = new perfis();
			$myuserDAO = new usuariosDAO($myuser);
			$myperfisDAO = new perfisDAO($perfis);
			$perfis_usuario = $myperfisDAO->findAll();
			$form_action;

			if (isset($_POST['f_id']) and $_POST['f_action'] == 'alterar'){
				$user_find = $myuserDAO->find($_POST["f_id"]);
				$myuser->setNome($user_find[0]->nome);
				$myuser->setEmail($user_find[0]->email);
				$myuser->setSenha($user_find[0]->senha);
				$myuser->setId($user_find[0]->id);
				print_r($user_find);
				$form_action = 'alterar.php';
			} else {
				$form_action = 'inserir.php';
			}

			echo "<form method='POST' action=".$form_action.">";
			echo "<H2>Nome: <input type='text' name='f_nome' value=".$myuser->getNome()."></H2>";
			echo "<br/>";
			echo "<H2>Email: <input type='text' name='f_mail' value=".$myuser->getEmail()."></H2>";
			echo "<br/>";
			if($form_action == 'alterar.php'){
				echo "<input type='password' name='f_senha' hidden=true value='".$myuser->getSenha()."' >";
				echo "<input type='password' name='f_id' value=".$myuser->getId()." hidden=true>";
			} else {
				echo "<h2>Senha:<input type='password' name='f_senha' value=".$myuser->getSenha()."></h2>";
			}
			echo "<select name='f_perfil'>";

			foreach ($perfis_usuario as $key => $value) {
				echo "<option value=".$value->id.">". $value->nome ."</option>";
			}

			echo "</select>";
			echo "<br><br>";
			echo "<input type='submit' value='Enviar'>";
			echo "</form>";

			if(isset($_POST['f_id']) and $_POST['f_action'] == 'excluir'){
				$myuserDAO->delete($_POST['f_id']);
			}

			else if (isset($_POST['f_id']) and $_POST['f_action'] == 'resetar_senha') {
				$myuserDAO->resetPassword($_POST['f_id'],'123456');
				echo "Senha resetada";
			}
		?>

		<div>
			<table border=1>
				<tr>
					<th width="20%">Nome</th>
					<th width="30%">E-mail</th>
					<th width="30%">Perfil do usuário</th>
				</tr>

				<?php foreach ($myuserDAO->findAll() as $key => $value) :?>
					<tr>
						<td><?php echo "$value->nome"; ?></td>
						<td><?php echo "$value->email"; ?></td>
						<td><?php echo "$value->id_perfis"; ?></td>
						<td>
							<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
								<input type='text' hidden=true name="f_id" value=<?php echo "$value->id"; ?>>
								<input type='text' hidden=true name="f_action" value="excluir">
								<button>Excluir</button>
							</form>
						</td>
						<td>
							<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
								<input type='text' hidden=true name="f_id" value=<?php echo "$value->id"; ?>>
								<input type='text' hidden=true name="f_action" value="alterar">
								<button>Alterar</button>
							</form>
						</td>
						<td>
							<form	action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
								<input type='text' hidden=true name="f_id" value=<?php echo "$value->id"; ?>>
								<input type='text' hidden=true name="f_action" value="resetar_senha">
								<button>Resetar Senha</button>
							</form>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
			<br><br>
			<a href="./gerar_relatorio.php" >Gerar relatório</a>
			<br><br>
		</div>
		</b>
	</body>
</html>
