<?php
  require_once 'Crud.php';

  class perfis extends Crud{
    protected $table = 'perfis';
    private $id;
    private $nome;

    public function getId(){
      return $this->id;
    }

    public function getNome(){
      return $this->nome;
    }

    public function setId($id){
      $this->id = $id;
    }

    public function setNome($nome){
      $this->nome = $nome;
    }

  	public function insert(){
  		$sql  = "INSERT INTO $this->table (nome, email, senha, id_perfis) VALUES (:nome, :email, :senha, :id_perfis)";
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

  }

?>
