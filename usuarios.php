<?php
require_once 'Crud.php';

class usuarios extends Crud{
	protected $table = 'usuarios';
	private $id;
	private $nome;
	private $email;
	private $senha;

	public function getId(){
		return $this->id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function insert(){
		$sql  = "INSERT INTO $this->table (nome, email, senha) VALUES (:nome, :email, :senha)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':email', $this->email);
		$this->senha = md5($this->senha);
		$stmt->bindParam(':senha', $this->senha);
		return $stmt->execute();
	}

	public function update($id){
		$sql  = "UPDATE $this->table SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':senha', $this->senha);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();
	}

	public function login(){
		$sql = "SELECT * FROM $this->table WHERE email = :email
						and senha = :senha";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':senha', $this->senha);
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0){
			$user_id = $stmt->fetchAll();
			$this->id = $user_id[0]->id;			
		}
		return $count;
	}

	public function resetPassword($id){
		$user_find = $this->find($id);
		$this->nome = $user_find[0]->nome;
		$this->email = $user_find[0]->email;
		$senha_padrao = md5(123456);
		$this->senha = $senha_padrao;
		$this->update($id);
	}
}

?>
