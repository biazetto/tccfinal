<?php
	
	namespace KauruJob\Controllers;

	class HomeController{


		public function index(){

			if(isset($_GET['loggout'])){
				session_unset();
				session_destroy();

				\KauruJob\Utilidades::redirect(INCLUDE_PATH);
			}


			if(isset($_SESSION['login'])){
				//Renderiza a home do usuário.

				

				if(isset($_GET['recusarAmizade'])){
					$idEnviou = (int) $_GET['recusarAmizade'];
					\KauruJob\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou,0);
					\KauruJob\Utilidades::alerta('Amizade Recusada :(');
					\KauruJob\Utilidades::redirect(INCLUDE_PATH);
				}else if(isset($_GET['aceitarAmizade'])){
					$idEnviou = (int) $_GET['aceitarAmizade'];
					if(\KauruJob\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou,1)){
					\KauruJob\Utilidades::alerta('Amizade aceita!');
					\KauruJob\Utilidades::redirect(INCLUDE_PATH);
					}else{
					\KauruJob\Utilidades::alerta('Ops.. um erro ocorreu!');
					\KauruJob\Utilidades::redirect(INCLUDE_PATH); //se a pessoa tentar mexer na URL, da esse erro
					}
				}


				//Existe postagem no feed?

		
				if(isset($_POST['post_feed'])){

					if($_POST['post_content'] == ''){
						\KauruJob\Utilidades::alerta('Não permitimos posts vázios :');
						\KauruJob\Utilidades::redirect(INCLUDE_PATH);
					}

					\KauruJob\Models\HomeModel::postFeed($_POST['post_content']);
					\KauruJob\Utilidades::alerta('Post feito com sucesso!');
					\KauruJob\Utilidades::redirect(INCLUDE_PATH);
				}

				

				
					
				\KauruJob\Views\MainView::render('home');
				}else{

				//Renderizar para criar conta.

				if(isset($_POST['login'])){
					$login = $_POST['email'];
					$senha = $_POST['senha'];

					

					//Verificar no banco de dados.

					$verifica = \KauruJob\MySql::connect()->prepare("SELECT * FROM usuarios WHERE email = ?");
					$verifica->execute(array($login));



					
					if($verifica->rowCount() == 0){
						//Não existe o usuário!
						\KauruJob\Utilidades::alerta('Não existe nenhum usuário com este e-mail...');
						\KauruJob\Utilidades::redirect(INCLUDE_PATH);
					}else{
						$dados = $verifica->fetch();
						$senhaBanco = $dados['senha'];
						if(\KauruJob\Bcrypt::check($senha,$senhaBanco)){
							//Usuário logado com sucesso
							$_SESSION['login'] = $dados['email'];
							$_SESSION['id'] = $dados['id'];
							$_SESSION['nome'] = explode(' ',$dados['nome'])[0];
							$_SESSION['img'] = $dados['img'];
							\KauruJob\Utilidades::alerta('Logado com sucesso!');
							\KauruJob\Utilidades::redirect(INCLUDE_PATH);
						}else{
							\KauruJob\Utilidades::alerta('Senha incorreta....');
							\KauruJob\Utilidades::redirect(INCLUDE_PATH);
						}
					}
					

				}

				\KauruJob\Views\MainView::render('login');
			}

		}

	}

?>