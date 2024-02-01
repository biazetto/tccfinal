<!DOCTYPE html>
<html>
<head>
	<!--ALTERAR TITULO-->
	<title>Bem-vindo, <?php echo $_SESSION['nome']; ?></title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/feed.css" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/vaga.css" rel="stylesheet">


</head>

<body>

	<section class="main-feed">
		<?php 
			include('includes/sidebar.php'); 
		?>
		<div class="feed">
            <div class="vaga">
                <div class="container-vaga">
                    <h4>Cadastro de Vagas</h4>
                    <div class="container-vaga-wraper">
                        <div class="container-vaga-single">
                            <div class="form-vaga">
                                <form method="post">
                                    <input type="hidden" name="post_vagas">

                                    <h3>Cargo da Vaga:</h3>
                                    <input required="" type="text" id="cargo" name="post_cargo" placeholder="Ex: Estágio Técnico em Telecomunicações ">

                                    <h2>Cidade:</h2>
                                    <input required=""type="text" id="cidade" name="post_cidade"placeholder="Ex: Atibaia/SP ">

                                    <h2>Sobre a Vaga: </h2>
                                    <textarea required=""id="sobre" name="post_sobre" rows="4" placeholder="Ex: Sabemos que iniciar a carreira profissional é um momento super importante, e o lugar que escolhemos para começar pode fazer uma diferença tremenda em nosso futuro.  " ></textarea>

                                    <h2>Tipo de Trabalho: </h2>
                                    <input required=""type="text" id="tipoTrabalho" name="post_tipoTrabalho"placeholder="Ex: Remoto ">

                                    <h2>Email: </h2>
                                    <input required=""type="email" id="email" name="post_email"placeholder="Ex: usf@edu.com.br ">

                                    <button type="submit" name="acaovaga" value="Enviado">Enviar</button>
                                </form>
										
								</div>  <!--form-vaga ou info-vaga-user-single-->
						</div> <!--container-vaga-single-->
					</div> <!--container-vaga-wraper-->
			<br/>
								<?php

								$vagas = \KauruJob\Models\VagaModel::ListarVagas();

								?>
<div class="container-vaga">
    <h4>Banco de Vagas</h4>
    <div class="container-vaga-wraper">
        <?php foreach ($vagas as $vaga): ?>
            <div class="container-vaga-single">
                <div class="info-vaga-user-single">
                    <h3>Cargo da Vaga: <?php echo $vaga['cargo']; ?></h3>
                    <br></br>
                    <h2>Cidade: <?php echo $vaga['cidade']; ?> </h2>
                    <h2>Sobre a Vaga: <?php echo $vaga['descricao']; ?> </h2>
                    <h2>Tipo de Trabalho: <?php echo $vaga['tipo_trabalho']; ?> </h2>
                    <h2>Email: <a href="mailto:<?php echo $vaga['email']; ?>"><?php echo $vaga['email']; ?></a></h2>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
			</div> 
		</div>
	</section>


</body>


</html>