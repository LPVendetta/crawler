<?php
	
	class Crawler{
		public function __construct(){
			
		}

		public function getLinks($url){
			$ch = curl_init();
			$timeout = 10;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$conteudo = curl_exec($ch);
			curl_close($ch);
			preg_match_all('/<a href=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?>/i', $conteudo, $resultados);

			return $resultados;
		}

		public function getEmails($url){
			$ch = curl_init();
			$timeout = 10;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$conteudo = curl_exec($ch);
			curl_close($ch);
			preg_match_all('/\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i', $conteudo, $resultados);

			return $resultados;
		}
	}

?>