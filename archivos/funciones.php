<?php
function crearConexion(){
	$servidor = "localhost";
	$usuario = "root";
	$password = "rootroot";
	$dataBase="adminturnos";

	try {
		$con = new PDO("mysql:host=$servidor;dbname=$dataBase", $usuario, $password);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $con;
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
}

function formularioEnviado(){
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		foreach($_POST as $input){
			if($input == null){
				return false;
			}
		}
		return true;
	}
	return false;
}

function limpiar($string){
	return trim(addslashes($string));
}
?>