<?PHP
$hostname_localhost="localhost";
$database_localhost="your_healthdb";
$username_localhost="root";
$password_localhost="";
$json=array();
	if( isset($_GET["idcitamedica"]) && isset($_GET["estado"]) && isset($_GET["idAdministrador"]) ){
		$idCitamedica= $_GET["idcitamedica"];
		$estado=$_GET["estado"];
		$idAdministrador=$_GET["idAdministrador"];
		$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
		$sqlm="UPDATE citamedica SET estadoCita =?, idAdministrador= ? WHERE idCita=?";
		$stmm=$conexion->prepare($sqlm);
		$stmm->bind_param('sss',$estado,$idAdministrador,$idCitamedica);
		if($stmm->execute()){
			echo "registra";
		}else{
			echo "no registraM";
		}
	
		
	}

	
?>