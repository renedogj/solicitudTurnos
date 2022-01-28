<?php
session_start();
$redireccion = "archivos/AdminTurnos.php";
if(isset($_SESSION['user'])){
	$user = $_SESSION['user'];
}else{
	$user = "";
}
include("archivos/funciones.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="contenedora">
		<div class="iniciosesion">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-inicio-sesion">
				<h1>Iniciar Sesion</h1>
				<div class="div-contenedora-labelinput">
					<label for="user">Usuario:</label>
					<input type="text" name="user" maxlength="45" size="30" value="<?php echo $user; ?>">
				</div>
				<div class="div-contenedora-labelinput">
					<label for="password">Contraseña:</label>
					<input name="password" type="password" size="30" maxlength="25" required placeholder=" Contraseña"/>
				</div>
				<button class="boton-iniciarsesion" id="boton" type="submit">Iniciar Sesión</button>
			</form>
		</div>
	</div>
	<?php
	if(formularioEnviado()){
		$user = $_POST['user'];
		$password = $_POST['password'];
		if($user == "admin" && $password == "admin"){
			$_SESSION['user'] = $user;
			header('Location: ' . $redireccion);
			die();
		}else{
			echo "Credenciales incorrectas";
		}
	}
	?>
</body>
</html>