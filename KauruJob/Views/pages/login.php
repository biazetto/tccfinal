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
		<img src="<?php echo INCLUDE_PATH_STATIC ?>images/logo.png" />
			<p>Encontre vagas inclusivas na sua comunidade e expanda seus contatos</p>
	</div>
</div>
	<div class="form-login">
				<form method="post">
					<input type="text" name="email" placeholder="Login...">
					<input type="password" name="senha" placeholder="Senha...">
					<input type="submit" name="acao" value="Logar!">
					<input type="hidden" name="login">
				</form>
				<p><a href="<?php echo INCLUDE_PATH ?>registrar">Criar Conta</a></p> <!--link para voltar para criação de conta, usando outra constante  -->
		</div><!--form-login-->


</div>
</body>
</html>