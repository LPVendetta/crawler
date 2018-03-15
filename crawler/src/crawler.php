<?php
	require 'ClasseBanco.php';
	require 'ClasseCrawler.php';

	$bd = new BancoDados();
	$con = $bd->conexaoBD();
	$listaURL = array();

	if($con->connect_error){
		die("Falha de Conexão: ".$con->connect_error);
	}

	$rs = $bd->processaQuery($con,"SELECT * FROM webx.urls");
	if ($rs->num_rows > 0) {
	    
	    while($row = $rs->fetch_assoc()) {
	        array_push($listaURL, $row);
	        if($row['visited'] == 'no'){
		        $c = new Crawler();
		        $links = $c->getLinks($row['url']);
		        $emails = $c->getEmails($row['url']);
		        $id = $row['id'];
		        
		        $urlOK = $bd->processaQuery($con,"UPDATE webx.urls SET visited='yes' WHERE id='$id'");

		        foreach ($links as $link) {
		        	foreach ($link as $l) {
		        		$urlsBD = $bd->processaQuery($con,"SELECT * FROM webx.urls WHERE url = '$l'");
		        		if($urlsBD->num_rows == 0){
		        			$insert = $bd->processaQuery($con,"INSERT INTO webx.urls(url) VALUES('$l')");
		        		}
		        	}
		        }
		        foreach ($emails as $mail) {
		        	foreach ($mail as $m) {
		        		$urlsBD = $bd->processaQuery($con,"SELECT * FROM webx.emails WHERE email ='$m'");
		        		if($urlsBD->num_rows == 0){
		        			$insert = $bd->processaQuery($con,"INSERT INTO webx.emails(email) VALUES('$m')");
		        		}
		        	}
		        }
		        
		    }
	    }
	    $con = $bd->conexaoBD();

			$busca10 = $bd->processaQuery($con,"SELECT email FROM emails ORDER BY id DESC LIMIT 10");
	    	while ($row = $busca10->fetch_assoc()) {
	    		echo $row['email']."<br>";
	   		}
	    /*foreach ($listaURL as $url) {
	    	echo $url["id"]." - ".$url["url"]."<br>";
	    }*/
	} else {
	    echo "0 resultados";
	}

?>