<?php

class usuarios {
	private $id;
	private $nome;
	private $email;
	private $senha;
	private $id_perfis;

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

	public function getId_perfis(){
		return $this->id_perfis;
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

	public function setId_perfis($id_perfis){
		$this->id_perfis = $id_perfis;
	}


}

?>
