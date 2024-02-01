<?php
	
	namespace KauruJob;
	class Utilidades

	{
		
		public static function redirect($url){
			echo '<script>window.location.href="'.$url.'"</script>'; 
			die();  //obrigatório o die para quie o código não continue sendo executado no servidor
		}

		public static function alerta($mensagem){
			echo '<script>alert("'.$mensagem.'")</script>';
			
			
		}
		
	}
?>