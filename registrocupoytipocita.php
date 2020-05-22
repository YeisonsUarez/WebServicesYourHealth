<?PHP
$hostname_localhost="localhost";
$database_localhost="your_healthdb";
$username_localhost="root";
$password_localhost="";


$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
	
	$tipoConsulta=$_POST["tipoConsulta"];
	$datoUno = $_POST["datoUno"];
	$datoDos = $_POST["datoDos"];
	$datoTres = $_POST["datoTres"];
	$institucion = $_POST["institucion"];
	
	
	if($tipoConsulta=="tipoCita")
	{
		$fotoPerfilUsuario = $datoTres;
		$nombre= $datoUno.$institucion;
		$nombre= str_replace(' ', '', $nombre);

		$path = "imagenes/".$nombre.".jpg";

		$url = "http://".$hostname_localhost."/YourHealthWebService/".$path;
		file_put_contents($path,base64_decode($fotoPerfilUsuario));
		$sql="INSERT INTO tipoCita (nombreTipoCita,detalleTipoCita,urlImagenCita,institucion) VALUES (?,?,?,?);";
		$stm=$conexion->prepare($sql);
		$stm->bind_param('ssss',$datoUno,$datoDos,$path,$institucion);
		if($stm->execute())
		{
		
		echo "registra";
		}else{
		echo "no registra";
		}
	
	}else{
		$sql="INSERT INTO cupo (lugar,hora,disponible,institucion) VALUES (?,?,?,?);";
		$stm=$conexion->prepare($sql);
		$stm->bind_param('ssss',$datoUno,$datoDos,$datoTres,$institucion);
		if($stm->execute())
		{
		
		echo "registra";
		}else{
		echo "no registra";
		}
		
	}
	
	mysqli_close($conexion);
?>