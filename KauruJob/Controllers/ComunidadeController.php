<?php
	
	namespace KauruJob\Controllers;

	class ComunidadeController{


		public function index(){
			if(isset($_SESSION['login'])){

				if(isset($_GET['solicitarAmizade'])){
					$idPara = (int) $_GET['solicitarAmizade'];
					if(\KauruJob\Models\UsuariosModel::solicitarAmizade($idPara)){
						
						\KauruJob\Utilidades::alerta('Amizade solicitada com sucesso!');
						\KauruJob\Utilidades::redirect(INCLUDE_PATH.'comunidade');
					}else{
						\KauruJob\Utilidades::alerta('Ocorreu um erro ao solicitar a amizade...');
						\KauruJob\Utilidades::redirect(INCLUDE_PATH.'comunidade');
					}
				}

			\KauruJob\Views\MainView::render('comunidade');
			}else{
				\KauruJob\Utilidades::redirect(INCLUDE_PATH);
			}
			
		}


	}

?>