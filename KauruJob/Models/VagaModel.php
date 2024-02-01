<?php
    
namespace KauruJob\Models;

class VagaModel {
    
    // ... (outras funções)

    public static function postVaga($cargo, $cidade, $descricao, $trabalho, $email) {
        $pdo = \KauruJob\MySql::connect();
        $postVaga = $pdo->prepare("INSERT INTO `vagas` VALUES (null, ?, ?, ?, ?, ?, ?)");

        $postVaga->execute(array($_SESSION['id'], $cargo, $cidade, $descricao, $trabalho, $email));
    }

    public static function ListarVagas(){
        $pdo = \KauruJob\MySql::connect();

        $listarVagas = [];

        $listarVagasQuery = $pdo->query("SELECT * FROM vagas");
        
        while ($vaga = $listarVagasQuery->fetch(\PDO::FETCH_ASSOC)) {
            $listarVagas[] = $vaga;
        }

        return $listarVagas;
    }
}

?>
