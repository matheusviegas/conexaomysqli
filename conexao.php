<?php

	// Autor: Matheus Souza
	// Repositório: https://github.com/matheusviegas/conexaomysqli
	// Página Oficial do Projeto: http://matheusviegas.github.io/conexaomysqli/


	// Protege contra SQL Injection
	function escape($data){
		$link = AbrirConexao();
		
		if(!is_array($data))
			$dados = mysqli_real_escape_string($link, $data);
		else {
			$arr = $data;
			
			foreach ($arr as $key => $value){
				$key 	= mysqli_real_escape_string($link, $key);
				$value	= mysqli_real_escape_string($link, $value);
				
				$data[$key] = $value;
			}
		}
		
		FecharConexao($link);
		return $data;
	}

	// Fecha Conexão com MySQL
	function FecharConexao($link){
		$link->close() or die ($link->error);
	}

	// Abre com Conexão com MySQL
	function AbrirConexao(){
		$link = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die($link->connect_error);
		$link->set_charset(DB_CHARSET) or die ($link->error);
		
		return $link;
	}
