<?php 

	class Sql extends PDO{ // classe PDO é nativa do sistema. Sql herda os métodos nativos (connect, bind-param, ...)

		private $conn;
		
		public function __construct(){

			$this->conn = new PDO("sqlsrv:Database=dbphp7;Server=localhost;ConnectionPooling=0","sa","Mateus76!94#");
			
			// o $this identifica o instanciamento de uma variável global
			// com isso, sempre que a classe for instanciada (new Sql) a conexão com o banco de dados será realizada automaticamente
		}

		private function setParam($statment,$key,$value){ // para o caso de somente um parâmetro e é um método que substitui o bindParam no setParams

			$statment->bindParam($key,$value);

		}

		private function setParams($statment,$parameters = array()){ // para o caso de diversos parâmetros

			foreach ($parameters as $key => $value){

				$this->setParam($key,$value); // substitui vários bindParam
				
			}
		} 

		public function query($rawQuery,$params = array()){

			$stmt = $this->conn->prepare($rawQuery);
			// $stmt é uma variável local

			$this->setParams($stmt,$params);

			$stmt->execute();
	
			return $stmt;
		}

		public function select($rawQuery,$params = array()):array{ // o método retorna um array

			$stmt = $this->query($rawQuery,$params); // recebe o $stmt do método query

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

	}
?>