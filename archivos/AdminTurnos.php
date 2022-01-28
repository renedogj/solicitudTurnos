<?php
session_start();
include("funciones.php");
if(!isset($_SESSION['user'])){
	header('Location: ' . "http://192.168.206.230/AdminTurnos/login.php");
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administracion turnos</title>
	<link rel="stylesheet" type="text/css" href="../css/Turnos.css">
</head>
<body>
	<h2>Turnos para hablar con el profesor</h2>
	<div id="divTurnoActual">
		<h4>Turno actual de:</h4>
		<p id="pNombreAlumno"></p>
		<button id="bttnSiguiente">Siguiente</button>
		<input type="hidden" name="inputIdAlumno" id="inputIdAlumno">
	</div>
	<br><br>
	<div id="divTablaAlumnos"></div>
	<script type="text/javascript">
		var divTablaAlumnos = document.getElementById("divTablaAlumnos");
		var inputIdAlumno = document.getElementById('inputIdAlumno');
		var pNombreAlumno = document.getElementById("pNombreAlumno");
		var bttnSiguiente = document.getElementById("bttnSiguiente");

		bttnSiguiente.addEventListener("click",function(){
			eliminar(inputIdAlumno.value);
		});

		cargarTabla();
		var interval = setInterval(cargarTabla, 10000);

		function cargarTabla(){
			const xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					divTablaAlumnos.innerHTML = this.responseText;
					var tdTurnoActual = document.getElementById("tdTurnoActual");
					if(tdTurnoActual != null){
						pNombreAlumno.textContent = tdTurnoActual.textContent; 
						inputIdAlumno.value = tdTurnoActual.parentNode.id;
					}
				}
			};
			xhttp.open("GET","Eliminar.php");
			xhttp.send();
		}

		function eliminar(id){
			const xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					divTablaAlumnos.innerHTML = this.responseText;
					var tdTurnoActual = document.getElementById("tdTurnoActual");
					if(tdTurnoActual != null){
						pNombreAlumno.textContent = tdTurnoActual.textContent; 
						inputIdAlumno.value = tdTurnoActual.parentNode.id;
					}else{
						pNombreAlumno.textContent = ""; 
						inputIdAlumno.value = "";
					}
				}
			};
			xhttp.open("GET", "Eliminar.php?id="+id);
			xhttp.send();
		}
	</script>
</body>
</html>