<?php
	
	namespace KauruJob;

	class MySql{ // É estático, para não ser aberto uma nova conexão com o banco de dados sempre que houver a conexão é criado uma classe para facilitar a comunicação e não gerar várias conexões no servidor

		private static $pdo;

		public static function connect(){
		if(self::$pdo == null){
				try{
				self::$pdo = new \PDO('mysql:host=localhost;dbname=rede_social','root','',array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
				self::$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
				}catch(Exception $e){
					echo 'erro ao conectar';
					error_log($e->getMessage());
				}
			}

			return self::$pdo;
		}

	}



?>