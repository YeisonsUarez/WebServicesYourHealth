<?PHP
$hostname_localhost="localhost";
$database_localhost="your_healthdb";
$username_localhost="root";
$password_localhost="";
$json=array();
	if( isset($_GET["tipoDocumento"]) && isset($_GET["numeroDocumento"]) && isset($_GET["contrasenaUsuario"]) ){
		$tipoDocumento= $_GET["tipoDocumento"];
		$numeroDocumento=$_GET["numeroDocumento"];
		$contrasenaUsuario=$_GET["contrasenaUsuario"];
		$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
		$consulta="select * from usuario where tipoDocumento='{$tipoDocumento}' and numeroDocumento = '{$numeroDocumento}' and contrasenaUsuario='{$contrasenaUsuario}'";
		$resultado_insert=mysqli_query($conexion,$consulta);
		//$insert="INSERT INTO ferreteria( nombreFerreteria, celular, email,contrasena) VALUES ('{$Nombre}','{$celular}','{$Email}','{$Contra}')";
	
			if ($registro=mysqli_fetch_array($resultado_insert))
			{	
				$json['usuario'][]=$registro;
				mysqli_close($conexion);
				echo json_encode($json);
			} else {
				$json['usuario'][]=null;
				mysqli_close($conexion);
				echo json_encode($json);
			}
		
	
		
	}

	
?>