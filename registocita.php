<?PHP
$hostname_localhost="localhost";
$database_localhost="your_healthdb";
$username_localhost="root";
$password_localhost="";
date_default_timezone_set('america/bogota');

function actual_date ()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $week_days[$week_day_now] . ", " . $day_now . " de " . $months[$month_now] . " de " . $year_now;   
    return $date;    
}  

$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
	
	$operacion=$_POST["operacion"];
	
	if($operacion=="insertar")
	{
		$idMedico=$_POST["idMedico"];
		$idTipoCita = $_POST["idTipoCita"];
		$idPaciente = $_POST["idPaciente"];
		$idAdministrador = $_POST["idAdministrador"];
		$detallesCita=$_POST["detallesCita"];
		$fechaCita = $_POST["fechaCita"];
		$estadoCita = $_POST["estadoCita"];
		$idCupo = $_POST["idCupo"];
		$institucion = $_POST["institucion"];
		$fechaCreacion=actual_date();
		$sql="INSERT INTO citamedica (idMedico,idTipoCita,idPaciente,idAdministrador,detallesCita,fechaCita,estadoCita,idCupo,institucion,fechaCreacion) VALUES (?,?,?,?,?,?,?,?,?,?);";
		$stm=$conexion->prepare($sql);
		
		$stm->bind_param('ssssssssss',$idMedico,$idTipoCita,$idPaciente,$idAdministrador,$detallesCita,$fechaCita,$estadoCita,$idCupo,$institucion,$fechaCreacion);	
		if($stm->execute()){
			echo "registra";
		}else{
			//echo "noRegistra";
			echo $stm->error;
		}
			
	}else
	{
		if($operacion="actualizar")
		{
			$idCita=$_POST["idCita"];
			$estadoCita=$_POST["estadoCita"];
			$sql="UPDATE citamedica SET estadoCita = '?' WHERE idCita=? ;";
			$stm=$conexion->prepare($sql);
			$stm->bind_param('ss',$idCita,$estadoCita);	
			if($stm->execute()){
				echo "registra";
			}else{
				//echo "noRegistra";
				echo $stm->error;
			}
		}
		
	}
	
	mysqli_close($conexion);
?>