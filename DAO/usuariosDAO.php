<?php
  require_once($_SERVER['DOCUMENT_ROOT'] . 'Aula06/classes/usuarios.php');
  require_once('Crud.php');


  class usuariosDAO extends Crud {
      private $d_usuario;
      protected $table = 'usuarios';

      public function __construct($p_usuario){
        $this->d_usuario = $p_usuario;
      }

      public function __clone(){ }

      public function __destruct(){
        foreach ($this as $key => $value):
            unset($this->$key);
        endforeach;

        foreach (array_keys(get_defined_vars()) as $var):
            unset(${"$var"});
        endforeach;
      }

      public function insert(){
        $sql  = "INSERT INTO $this->table (nome, email, senha, id_perfis) VALUES
        ('".$this->d_usuario->getNome()."', '".$this->d_usuario->getEmail()."',
        '".$this->d_usuario->getSenha()."', '".$this->d_usuario->getId_perfis()."')";
    		$stmt = DB::prepare($sql);
    		return $stmt->execute();
    	}

      public function update($id){
        $nome = $this->d_usuario->getNome();
        $email = $this->d_usuario->getEmail();
        $senha = $this->d_usuario->getSenha();
        $id_perfil = $this->d_usuario->getId_perfis();

        $sql  = "UPDATE $this->table SET nome = '".$nome."', email = '".$email."', senha
        = '".$senha."', id_perfis = '".$id_perfil."' WHERE id = '".$id."'";

    		$stmt = DB::prepare($sql);
    		return $stmt->execute();
    	}

      public function login(){
    	    $sql = "SELECT id FROM $this->table WHERE email = '" . $this->d_usuario->getEmail() . "' and senha = '";
    	    $sql = $sql . $this->d_usuario->getSenha() . '\'';
    	    $stmt = DB::prepare($sql);
    		$stmt->execute();
    		$ident = $stmt->fetchAll();
        
    		foreach ($ident as $key => $value) {
    			if ($value->id > 0) {
    				return $value->id;
    			} else {
    				return 0;
    			}
    		}
    	}

      public function resetPassword($id, $senha){
        $sql = "UPDATE $this->table SET senha = :senha WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();

    	}

      public function load(){
        $arr = $this->findAll();
        foreach ($arr as $chave => $valor) {
          $objeto = new usuarios();
          $objeto->setId($valor->id);
          $objeto->setNome($valor->nome);
          $objeto->setEmail($valor->email);
          $objeto->setSenha($valor->senha);
          $objeto->setId_perfis($valor->id_perfis);
          $arrUsuarios[] = $objeto;
        }
        return $arrUsuarios;
      }
  }

?>
