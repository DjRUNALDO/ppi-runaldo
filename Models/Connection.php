<?php
	class Connection{
		
		public static function insert($bank, $cols, $values){
			$sql = "INSERT INTO " . $bank . " (" . $cols . ") VALUES (" . $values . ");";
			
			echo $sql;
			
			Connection::getConnection()->exec($sql);
		}
		
		public static function delete($bank, $id){
			$sql = "DELETE FROM $bank WHERE id=$id;";
			Connection::getConnection()->exec($sql);
		}
		
		public static function select($bank, $cols){
			$sql = "SELECT $cols FROM $bank;";
			
			echo $sql;
			
			$resource = self::getConnection()->prepare($sql);
			$resource->execute();
			
			return $resource->fetchAll();
		}
		
		public static function selectById($bank, $cols, $id){
			$sql = "SELECT $cols FROM $bank WHERE id=$id;";
			
			$resource = self::getConnection()->prepare($sql);
			$resource->execute();
			
			return $resource->fetchAll();
		}
		
		public static function update($bank, $param, $id){
			$sql = "UPDATE $bank SET $param WHERE id=$id;";
			
			$resource = self::getConnection()->prepare($sql);
			$resource->execute();
			
			return $resource->fetchAll();
		}
		
		private static function getConnection(){
			try{
				$connection = new PDO("mysql:host=localhost;dbname=ppi4v_apostas;", "ppi4v", "ppi42@ifrn");
				$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				return $connection;
			}
			
			catch(PDOException $e){
				echo "Error: " . $e->getMessage();
			}
		}
		
	}