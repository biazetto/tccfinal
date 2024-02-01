<?php
    
    namespace KauruJob\Models;

    class HomeModel{


        public static function postFeed($post){

            $pdo = \KauruJob\MySql::connect();
            $post = strip_tags($post);

            // Verifica se a string contém links de imagens
            if (preg_match('/\b(https?:\/\/[^\s]+(\.png|\.jpg))\b/', $post)) {
            // Substitui os links de imagens por tags de imagem
             $post = preg_replace('/(.*?)(https?:\/\/[^\s]+(\.png|\.jpg))(.*?)\b/', '<p>$1</p><img src="$2" />', $post);

            } else {
            // Se não houver links de imagens, envolve o conteúdo em um parágrafo
            $post = '<p>' . $post . '</p>';
            }


            


                
            $postFeed = $pdo->prepare("INSERT INTO `posts` VALUES (null,?,?,?)");
            $postFeed->execute(array($_SESSION['id'],$post,date('Y-m-d H:i:s',time())));

            $atualizaUsuario = $pdo->prepare("UPDATE usuarios SET ultimo_post = ? WHERE id = ?");
            $atualizaUsuario->execute(array(date('Y-m-d H:i:s',time()),$_SESSION['id']));





            }




public static function retrieveFriendsPosts(){
    $pdo = \KauruJob\MySql::connect();
    $amizades = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND status = 1) OR (recebeu = ? AND status = 1)");
    $amizades->execute(array($_SESSION['id'], $_SESSION['id']));
    $amizades = $amizades->fetchAll();
    $amigosConfirmados = array();

    foreach ($amizades as $key => $value) {
        if($value['enviou'] == $_SESSION['id']){
            $amigosConfirmados[] = $value['recebeu'];
        } else {
            $amigosConfirmados[] = $value['enviou'];
        }
    }

    $listaAmigos = array();

    foreach ($amigosConfirmados as $key => $value) {
        $listaAmigos[$key]['id'] = \KauruJob\Models\UsuariosModel::getUsuarioById($value)['id'];
        $listaAmigos[$key]['nome'] = \KauruJob\Models\UsuariosModel::getUsuarioById($value)['nome'];
        $listaAmigos[$key]['email'] = \KauruJob\Models\UsuariosModel::getUsuarioById($value)['email'];
        $listaAmigos[$key]['img'] = \KauruJob\Models\UsuariosModel::getUsuarioById($value)['img'];
        $listaAmigos[$key]['ultimo_post'] = \KauruJob\Models\UsuariosModel::getUsuarioById($value)['ultimo_post'];
    }

    usort($listaAmigos, function($a, $b){
        if(strtotime($a['ultimo_post']) > strtotime($b['ultimo_post'])){
            return -1;
        } else {
            return +1;
        }
    });

    $posts = [];

    // Busca os posts do próprio usuário
    $meusPosts = $pdo->prepare("SELECT * FROM posts WHERE usuario_id = ? ORDER BY date DESC");
    $meusPosts->execute(array($_SESSION['id']));
    $meusPosts = $meusPosts->fetchAll();

    foreach ($meusPosts as $post) {
        $posts[] = array(
            'usuario' => $_SESSION['nome'],
            'img' => ($_SESSION['img'] == '') ? INCLUDE_PATH_STATIC . 'images/avatar.jpg' : INCLUDE_PATH . 'uploads/' . $_SESSION['img'],
            'data' => $post['date'],
            'conteudo' => $post['post'],
            'me' => true
        );
    }

    foreach ($listaAmigos as $key => $value) {
        $postsUsuario = $pdo->prepare("SELECT * FROM posts WHERE usuario_id = ? ORDER BY date DESC");
        $postsUsuario->execute(array($value['id']));
        $postsUsuario = $postsUsuario->fetchAll();

        foreach ($postsUsuario as $postUsuario) {
            $posts[] = array(
                'usuario' => $value['nome'],
                'img' => $value['img'],
                'data' => $postUsuario['date'],
                'conteudo' => $postUsuario['post']
            );
        }
    }

    $me = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $me->execute(array($_SESSION['id']));
    $me = $me->fetch(); 

    if(isset($posts[0])){
        if(strtotime($me['ultimo_post']) > strtotime($posts[0]['data'])) {
            $ultimoPost = $pdo->prepare("SELECT * FROM posts WHERE usuario_id = ? ORDER BY date DESC");
            $ultimoPost->execute(array($_SESSION['id']));
            $ultimoPost = $ultimoPost->fetchAll()[0];
            array_unshift($posts, array('data'=>$ultimoPost['date'],'conteudo'=>$ultimoPost['post'],'me'=>true  ));
        }
    }

    return $posts;
    

        }
}