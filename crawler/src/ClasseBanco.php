<?php
	
	/**
	* 
	*/
	class BancoDados {
		public $Host ='';
		public $Usuario ='';
		public $Senha ='';
		public $Nomebanco ='';

		public function bancoDados()
		{
			$Host="localhost";
			$Usuario="root";
			$Senha="";
			$Nomebanco="webx";
		}

		public function conexaoBD(){
			$con = new mysqli("localhost","root","sismap","webx");
			return $con;
		}

		public function processaQuery($con, $query){
			$resultSet = $con->query($query);
			return $resultSet;
		}

		public function buscaEmails(){
			$con = $this->conexaoBD();

			$busca10 = $this->processaQuery($con,"SELECT email FROM emails ORDER BY id DESC LIMIT 10");
	    	while ($row = $busca10->fetch_assoc()) {
	    		echo $row['email']."<br>";
	   		}
		}

	}

	if(isset($_POST['action']) && !empty($_POST['action'])) {
	    $action = $_POST['action'];
	    if($action == 'busca10'){
	    	$b = new bancoDados();
	    	$b->buscaEmails();
	    }
	}

?>