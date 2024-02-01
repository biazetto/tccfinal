<?php
	namespace KauruJob;
	class Application
	{
		private $controller;

		private function setApp(){

			$loadName = 'KauruJob\Controllers\\';
			$url = explode('/',@$_GET['url']);

			if($url[0] == ''){
				$loadName.='Home';

			}else{
				$loadName.=ucfirst(strtolower($url[0]));
			}

			$loadName.='Controller';

			if(file_exists($loadName.'.php')){
				$this->controller = new $loadName();
			}else{
				include('Views/pages/404.php');   //Caso a pagina não exista ele vai enviar para pagina de erro em pages
				die();  //Para tirar o carregamento do index e só aparecer a msg
			}

			
		}
		
		public function run(){
			$this->setApp();
			$this->controller->index();
		}
		
	}

?>