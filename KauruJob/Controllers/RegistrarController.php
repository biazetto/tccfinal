<?php
	
	namespace KauruJob\Controllers;

	class RegistrarController
	{
		public function index()
		{
			if (isset($_POST['registrar'])) {
				$nome = $_POST['nome'];
				$email = $_POST['email'];
				$senha = $_POST['senha'];

				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					\KauruJob\Utilidades::alerta('E-mail Inválido.');
					\KauruJob\Utilidades::redirect(INCLUDE_PATH . 'registrar');
				} elseif (strlen($senha) < 6) {
					\KauruJob\Utilidades::alerta('Sua senha é muito curta.');
					\KauruJob\Utilidades::redirect(INCLUDE_PATH . 'registrar');
				} elseif (\KauruJob\Models\UsuariosModel::emailExists($email)) {
					\KauruJob\Utilidades::alerta('Este e-mail já existe no banco de dados!');
					\KauruJob\Utilidades::redirect(INCLUDE_PATH . 'registrar');
				} else {
					// Registrar usuário.
					$senha = \KauruJob\Bcrypt::hash($senha);
					$registro = \KauruJob\MySql::connect()->prepare("INSERT INTO usuarios (nome, email, senha, img) VALUES (?, ?, ?, '')");
					$registro->execute(array($nome, $email, $senha));

					\KauruJob\Utilidades::alerta('Registrado com sucesso!');
					\KauruJob\Utilidades::redirect(INCLUDE_PATH);
				}
			}

			\KauruJob\Views\MainView::render('registrar');
		}
	}
?>
