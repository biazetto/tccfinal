<!DOCTYPE html>
<html>
<head>
	<title>Login na Kauru</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/style.css" rel="stylesheet"> <!--Constante estática para comunicar com a style css -->




</head>
<body>

<div class="sidebar"></div> <!-- Side Bar do background da esquerda background-color: #EAEAF4 do style css --> 
<div class="form-container-login"> 
	<div class="logo-chamada-login">
		<img src="<?php echo INCLUDE_PATH_STATIC ?>images/logo.svg" />
			<p>Encontre vagas inclusivas na sua comunidade e expanda seus contatos</p>
	</div>
</div>
	<div class="form-login">
			<h3 style="text-align: center;">Crie sua Conta</h3>
				<form method="post">

					<input type="text" name="nome" placeholder="Seu nome.. .">
					<input type="text" name="email" placeholder="E-mail...">
					<input type="password" name="senha" placeholder="Senha...">
					<input type="submit" name="acao" value="Criar Conta!">
					<input type="hidden" name="registrar" value="registrar">
					
				</form>
				
		</div><!--form-login-->


</div>
</body>
</html>