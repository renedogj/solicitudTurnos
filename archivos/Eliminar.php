<?php
include("funciones.php");
include("Alumno.php");

$con = crearConexion();

if(isset($_GET['id']) && $_GET['id'] != ""){
	$alumno = Alumno::eliminarAlumno($con,$_GET['id']);
}

$alumnos = Alumno::obtenerListaAlumnos($con);
Alumno::mostrarTablaAlumnos($alumnos,true);
$con = null;
?>