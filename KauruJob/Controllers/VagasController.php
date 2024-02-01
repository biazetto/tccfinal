<?php
namespace KauruJob\Controllers;

class VagasController {
    
    public function index() {
        if (isset($_SESSION['login'])) {

            if (isset($_POST['post_vagas'])) {
                // Verificar se os campos obrigatórios estão preenchidos
                if (empty($_POST['post_cargo']) || empty($_POST['post_cidade']) || empty($_POST['post_sobre']) || empty($_POST['post_tipoTrabalho']) || empty($_POST['post_email'])) {
                    \KauruJob\Utilidades::alerta('Por favor, preencha todos os campos.');
                    \KauruJob\Utilidades::redirect(INCLUDE_PATH . 'vagas');
                    exit();
                }

                // Processar o formulário e cadastrar a vaga
                \KauruJob\Models\VagaModel::postVaga(
                    $_POST['post_cargo'],
                    $_POST['post_cidade'],
                    $_POST['post_sobre'],
                    $_POST['post_tipoTrabalho'],
                    $_POST['post_email']
                );

                // Redirecionar o usuário para uma nova página
                \KauruJob\Utilidades::alerta('Vaga cadastrada com sucesso!');
                \KauruJob\Utilidades::redirect(INCLUDE_PATH . 'vagas');
                exit(); // Certifique-se de sair para evitar qualquer execução adicional
            }

            $vagas = \KauruJob\Models\VagaModel::ListarVagas();

            \KauruJob\Views\MainView::render('vagas', ['vagas' => $vagas]);
        } else {
            \KauruJob\Utilidades::redirect(INCLUDE_PATH);
        }
    }
}
?>
