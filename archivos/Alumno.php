<?php
class Alumno{
	public $id;
	public $nombre;
	public $fecha;

	public function __construct($id,$nombre){
		$this->id = $id;
		$this->nombre = $nombre;
	}

	public static function nuevoAlumno($con,$nombre){
		$cod = self::obtenerNuevoId($con);
		return new Alumno($cod,$nombre);
	}

	public static function arrayAlumnos($arrayAlumnos){
		$alumnos = array();
		foreach($arrayAlumnos as $alumno){
			$alumno = new Alumno($alumno["id"],$alumno["nombre"]);
			array_push($alumnos, $alumno);
		}
		return $alumnos;
	}

	public static function mostrarTablaAlumnos($alumnos,$admin){
		if(count($alumnos) > 0){
			if(!$admin){
				echo "<table>";
				echo "<tr>
						<th>Turno</th>
						<th>Alumno</th>
					</tr>";
				foreach($alumnos as $turno => $alumno) {
					echo "<tr>";
						if($turno == 0){
							echo "<td>Actual</td>
								<td id='tdTurnoActual'>" . $alumno->nombre . "</td>";
						}else{
							echo "<td>" . $turno . "</td>
								<td>" . $alumno->nombre . "</td>";
						}
					echo "</tr>";
				}
				echo "</table>";
			}else{
				echo "<table>";
				echo "<tr>
						<th></th>
						<th>Turno</th>
						<th>Alumno</th>
					</tr>";
				foreach($alumnos as $turno => $alumno) {
					echo "<tr id=\"".$alumno->id."\">
							<td class='tdBttn'><button onclick='eliminar(\"".$alumno->id."\")'>Eliminar</button></td>" ;
						if($turno == 0){
							echo "<td>Actual</td>
								<td id='tdTurnoActual'>" . $alumno->nombre . "</td>";
						}else{
							echo "<td>" . $turno . "</td>
								<td>" . $alumno->nombre . "</td>";
						}
					echo "</tr>";
				}
				echo "</table>";
			}
		}else{
			echo "<p>No hay nadie en la cola</p>";
		}
	}

	public function addAlumno($con){
		try {
			$sql = "INSERT INTO alumnos (id,nombre) VALUES ('$this->id','$this->nombre')";

			return $con->exec($sql);
		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
			return false;
		}
	}

	public static function obtenerNuevoId($con){
		$sql="SELECT max(id) as max from alumnos";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$arrayResultado = $stmt->fetchAll();

		if(count($arrayResultado) == 1){
			$lastId = (Int) substr($arrayResultado[0]["max"],1,3);
			$lastId++;
			while(strlen($lastId) != 3){
				$lastId = "0" . $lastId;
			}
			return "A" . $lastId;
		}
	}

	public static function obtenerListaAlumnos($con){
		$sql = "SELECT id,nombre from alumnos order by fecha";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$arrayAlumnos = new RecursiveArrayIterator($stmt->fetchAll());
		return self::arrayAlumnos($arrayAlumnos);
	}

	public static function eliminarAlumno($con,$id){
		$sql = "DELETE from alumnos where id='$id'";
		return $con->exec($sql);
	}
}
?>