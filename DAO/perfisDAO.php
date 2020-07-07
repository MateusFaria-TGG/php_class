<?php
  class perfisDAO extends Crud {
    private $d_perfil;
    protected $table = 'perfis';
    public function __construct() {}
    public function __clone(){}
    public function __destruct(){}

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

    public function load(){
      $arr = $this->findAll();
      foreach($arr as $chave => $valor){
        $objeto = new perfis();
        $objeto->setId($valor->id);
        $objeto->setNome($valor->nome);
        $arrPerfis[] = $objeto;
      }
      return $arrPerfis;
    }
  }
?>
