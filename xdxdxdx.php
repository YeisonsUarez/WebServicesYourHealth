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
	
	$numeroDocumento=$_POST["numeroDocumento"];
	$tipoDocumento = $_POST["tipoDocumento"];
	$nombreUsuario = $_POST["nombreUsuario"];
	$fechaNacimientoUsuario = $_POST["fechaNacimientoUsuario"];
	$sexoUsuario=$_POST["sexoUsuario"];
	$correoUsuario = $_POST["correoUsuario"];
	$contrasenaUsuario = $_POST["contrasenaUsuario"];
	$telefonoUsuario = $_POST["telefonoUsuario"];
	$institucionUsuario = $_POST["institucionUsuario"];
	$tipoUsuario = $_POST["tipoUsuario"];
	$fotoPerfilUsuario = $_POST["fotoPerfilUsuario"];
	$fechaRegistro=actual_date();
	$fechaRegistro = str_replace(' ', '', $fechaRegistro);
	$nombre= $numeroDocumento;

	$path = "imagenes/".$nombre.".jpg";

	$url = "http://".$hostname_localhost."/YourHealthWebService/".$path;
	file_put_contents($path,base64_decode($fotoPerfilUsuario));
	//$bytesArchivo=file_get_contents($path);

	$sql="INSERT INTO usuario (numeroDocumento,tipoDocumento,nombreUsuario,fechaNacimientoUsuario,sexoUsuario,correoUsuario,contrasenaUsuario,telefonoUsuario,institucionUsuario,fotoPerfilUsuario,tipoUsuario,fechaRegistro) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
	$stm=$conexion->prepare($sql);
	
	$stm->bind_param('ssssssssssss',$numeroDocumento,$tipoDocumento,$nombreUsuario,$fechaNacimientoUsuario,$sexoUsuario,$correoUsuario,$contrasenaUsuario,$telefonoUsuario,$institucionUsuario,$path,$tipoUsuario,$fechaRegistro);	
	if($stm->execute()){
		
		if($tipoUsuario=="Medico"){
			$areasDeTrabajo=$_POST["areasDeTrabajo"];
			$var = json_decode($areasDeTrabajo,true);
			$descripcion=$_POST["descripcion"];
			$sqlm="INSERT INTO medico VALUES (?,?)";
			$stmm=$conexion->prepare($sqlm);
			$stmm->bind_param('ss',$numeroDocumento,$descripcion);
			if($stmm->execute()){
				foreach ($var as &$valor) {
					$aniosExp=$valor["aniosExperiencia"];
					$idTipoCita=$valor["tipoCita"]["idTipo"];
					$sqlarea="INSERT INTO areastrabajo (aniosExp,idTipoCita,idMedico) values (?,?,?)"; 
					$stm=$conexion->prepare($sqlarea);
					$stm->bind_param('sss',$aniosExp,$idTipoCita,$numeroDocumento);	
					if($stm->execute()){
						$consulta="SELECT @@identity AS id";
						$resultado=mysqli_query($conexion,$consulta);
			
						if($registro=mysqli_fetch_array($resultado)){
							$idarea=$registro['id'];
							foreach($valor["cuposAreaTrabajo"] as $cupo){
								$idCupo=$cupo["idCupo"];
								$sqlcupo="INSERT INTO areatrabajo_cupo (idareatrabajo,idcupo) values (?,?)"; 
								$stm=$conexion->prepare($sqlcupo);
								$stm->bind_param('ss',$idarea,$idCupo);	
								if($stm->execute()){
								echo "registra";
								}else{
								echo $stm->error;
								}
							
							
							}
							
						}else{
							echo $stm->error;
						}
	
					}else{
						echo $stm->error;
					}
					
				}
			}else{
				echo $stm->error;
			}
			

			
		}else{
			echo "registra";

		}
		
	}else{
		//echo "noRegistra";
		echo $stm->error;
	}
	
	mysqli_close($conexion);
?>