<?php
	include "usuarios.php";
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
			$id;
			if(isset($_GET["id"])){
				$user_find = $myuser->find($_GET["id"]);
				$myuser->setNome($user_find[0]->nome);
				$myuser->setEmail($user_find[0]->email);
				$myuser->setSenha($user_find[0]->senha);
				$id = $user_find[0]->id;
				print_r($user_find);
			}
			echo "<form method='POST' action=".$_SERVER['PHP_SELF'].">";
			echo "<H2>Nome: <input type='text' name='f_nome' value=".$myuser->getNome()."></H2>";
			echo "<br/>";
			echo "<H2>Email: <input type='text' name='f_mail' value=".$myuser->getEmail()."></H2>";
			echo "<br/>";
			if(strlen($myuser->getSenha() > 1)){
				echo "<input type='password' hidden=true name='f_senha' value=".$myuser->getSenha().">";
			} else {
				echo "<h2>Senha:<input type='password' name='f_senha' value=".$myuser->getSenha()."></h2>";
			}

			if(isset($id)){
				echo "<input type='number' hidden=true name='f_id' value=".$id.">";
			}
			echo "<input type='submit' value='Enviar'>";
			echo "</form>";

			if(isset($_POST['f_nome']) and isset($_POST['f_mail']) and isset($_POST['f_senha']) and isset($_POST['f_id'])){
				$myuser->setNome($_POST['f_nome']);
				$myuser->setEmail($_POST['f_mail']);
				$myuser->setSenha($_POST['f_senha']);
				$myuser->update($_POST['f_id']);
			}

			else if(isset($_POST['f_nome']) and isset($_POST['f_mail']) and isset($_POST['f_senha'])){
				$myuser->setNome($_POST['f_nome']);
				$myuser->setEmail($_POST['f_mail']);
				$myuser->setSenha($_POST['f_senha']);
				$myuser->insert();
			}

			else if(isset($_POST['f_id']) and $_POST['f_action'] == 'excluir'){
				$myuser->delete($_POST['f_id']);
			}

			else if (isset($_POST['f_id']) and $_POST['f_action'] == 'resetar_senha') {
				$myuser->resetPassword($_POST['f_id']);
				echo "Senha resetada";
			}
		?>

		<div>
			<table border=1>
				<tr>
					<th width="20%">Nome</th>
					<th width="30%">E-mail</th>
				</tr>

				<?php foreach ($myuser->findAll() as $key => $value) :?>
					<tr>
						<td><?php echo "$value->nome"; ?></td>
						<td><?php echo "$value->email"; ?></td>
						<td>
							<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
								<input type='text' hidden=true name="f_id" value=<?php echo "$value->id"; ?>>
								<input type='text' hidden=true name="f_action" value="excluir">
								<button>Excluir</button>
							</form>
						</td>
						<td>
							<?php
								echo "<a href='?id=".$value->id."'>Alterar</a>";
							?>
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
		</div>
		</b>
	</body>
</html>
