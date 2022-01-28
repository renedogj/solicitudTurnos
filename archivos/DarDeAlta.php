<?php
include("funciones.php");
include("Alumno.php");

$con = crearConexion();

if(isset($_GET['nombre']) && $_GET['nombre'] != ""){
	$alumno = Alumno::nuevoAlumno($con,$_GET['nombre']);
	$alumno->addAlumno($con);
}

$alumnos = Alumno::obtenerListaAlumnos($con);
Alumno::mostrarTablaAlumnos($alumnos,false);
$con = null;
?>