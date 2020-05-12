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
		return $count;
	}
}

?>