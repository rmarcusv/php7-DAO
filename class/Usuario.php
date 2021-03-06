<?php 

	class Usuario{

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

/*----------------------------------------------------------------------*/

	    public function getIdusuario(){
	        return $this->idusuario;
	    }

	    public function setIdusuario($value){
	        $this->idusuario = $value;
	    }

/*----------------------------------------------------------------------*/

	    public function getDeslogin(){
	        return $this->deslogin;
	    }

	    public function setDeslogin($value){
	        $this->deslogin = $value;
	    }

/*----------------------------------------------------------------------*/

	    public function getDessenha(){
	        return $this->dessenha;
	    }

	    public function setDessenha($value){
	        $this->dessenha = $value;
	    }

/*----------------------------------------------------------------------*/

	    public function getDtcadastro(){
	        return $this->dtcadastro;
	    }

	    public function setDtcadastro($value){
	        $this->dtcadastro = $value;
	    }

/*----------------------------------------------------------------------*/
	    
	    public function loadbyId($id){
	    	$sql = new Sql();

	    	$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
	    		":ID"=>$id
	    	));
	    	
	    	if(count($results) > 0){
	    		
	    		$this->setData($results[0]);
	    	}
	    }

/*----------------------------------------------------------------------*/

	    public static function getList(){
	    	$sql = new Sql(); // não utilizou o this, podendo então ser um método estático

	    	return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");

	    }

/*----------------------------------------------------------------------*/

	    public static function search($login){

	    	$sql = new Sql();

	    	return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
	    		':SEARCH'=>"%".$login."%"
	    	));
	    }

/*----------------------------------------------------------------------*/

	    public function login($login,$password){

	    	$sql = new Sql();

	    	$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
	    		":LOGIN"=>$login,
	    		":PASSWORD"=>$password
	    	));

	    	if(count($results) > 0){

	    		$this->setData($results[0]);
	    	} else {

	    		echo ("Login e/ou senha inválidos");
	    	}
	    }

/*----------------------------------------------------------------------*/
	  	
	    public function insert(){

	    	$sql = new Sql();

			$results = $sql->select("EXEC sp_usuarios_insert :LOGIN, :PASSWORD", array( // sp_usuarios_insert é uma procedure do banco de dados, que vai executar e retornar o id gerado
	    		':LOGIN'=>$this->getDeslogin(),
	    		':PASSWORD'=>$this->getDessenha()
	    	));


	    	if(count($results) > 0){

	    		$this->setData($results[0]);
	    	} else {

	    		echo ("Login e/ou senha inválidos");
	    	}
	    }

/*----------------------------------------------------------------------*/

		public function update($login, $senha){

			$sql = new Sql();

			$this->setDeslogin($login);
			$this->setDessenha($senha);


			$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha(),
				':ID'=>$this->getIdusuario()
			));
		}

/*----------------------------------------------------------------------*/

		public function delete(){

			$sql = new Sql();

			$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
				':ID'=>$this->getIdusuario()
			));

			// apagou do BD, mas ainda consta no objeto. Para zerar:
			$this->setIdusuario(0);
			$this->setDeslogin("");
			$this->setDessenha("");
			$this->setDtcadastro(new DateTime());
		}

/*----------------------------------------------------------------------*/
		public function __construct($login ="", $senha = ""){ // ="" indica que o valor padrão é vazio

			$this->setDeslogin($login);
			$this->setDessenha($senha);
		
		}

/*----------------------------------------------------------------------*/

	    public function setData($data){

	    		$row = $data;
				$this->setIdusuario($row['idusuario']);	    	
	    		$this->setDeslogin($row['deslogin']);
	    		$this->setDessenha($row['dessenha']);
	    		$this->setDtcadastro(new DateTime($row['dtcadastro']
	    	));
	    }

/*----------------------------------------------------------------------*/

	    public function __toString(){
	    	return json_encode(array(
	    		"idusuario"=>$this->getIdusuario(),
	    		"deslogin"=>$this->getDeslogin(),
	    		"dessenha"=>$this->getDessenha(),
	    		"dtcadastro"=>$this->getDtcadastro()->format("d|m|Y H:i:s")
	    	));
	    }
	}
?>