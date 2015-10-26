<?php

	// Autor: Matheus Souza
	// Repositório: https://github.com/matheusviegas/conexaomysqli
	// Página Oficial do Projeto: http://matheusviegas.github.io/conexaomysqli/

	require "config.php";
	require "conexao.php";
	
	class ConexaoMysqli{

	// Deleta Registros
	function delete($table, $where = null){
		if(DB_PREFIX != null){
		$table 	= DB_PREFIX.'_'.$table;
		}

		$where	= ($where) ? " WHERE {$where}" : null;
		
		$query 	= "DELETE FROM {$table}{$where}";
		return self::executar($query);
	}
	
	// Altera Registros
	function update($table, array $data, $where = null, $insertId = false){
		foreach ($data as $key => $value){
			$fields[] = "{$key} = '{$value}'";
		}
		
		$fields = implode(', ', $fields);
		
		if(DB_PREFIX != null){
		$table 	= DB_PREFIX.'_'.$table;
		}

		$where	= ($where) ? " WHERE {$where}" : null;
		
		$query 	= "UPDATE {$table} SET {$fields}{$where}";
		return self::executar($query, $insertId);
	}
	
	// Ler Registros
	function select($table, $where = null, $fields = '*'){
		if(DB_PREFIX != null){
		$table 	= DB_PREFIX.'_'.$table;
		}
		
		$where = ($where) ? " WHERE {$where}" : null;
		
		$query 	= "SELECT {$fields} FROM {$table}{$where}";
		$result	= self::executar($query);
		
		if(!mysqli_num_rows($result))
			return false;
		else {
			while ($res = mysqli_fetch_assoc($result)){
				$data[] = $res;
			}
			
			return $data;
		}
	}
	
	// Grava Registros
	function insert($table, array $data, $insertId = false){
		if(DB_PREFIX != null){
		$table 	= DB_PREFIX.'_'.$table;
		}

		$data 	= escape($data);
		
		$fields	= implode(', ', array_keys($data));
		$values = "'".implode("', '", $data)."'";
		
		$query 	= "INSERT INTO {$table} ( {$fields} ) VALUES ( {$values} )";
		
		return self::executar($query, $insertId);
	}
	
	// Executa Querys
	function executar($query, $insertId = false){
		$link 	= AbrirConexao();

		$result = @mysqli_query($link, $query) or die(mysqli_error($link));

		if($insertId){
			$result = mysqli_insert_id($link);
		}
		
		FecharConexao($link);

		return $result;
	}




} // Fim Class
