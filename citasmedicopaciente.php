<?PHP
$hostname_localhost="localhost";
$database_localhost="your_healthdb";
$username_localhost="root";
$password_localhost="";
$json=array();
$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$entidad=$_GET["entidad"];
$tipoUsuario=$_GET["tipoUsuario"];
$idUsuario=$_GET["extra"];
$institucion=$_GET["institucion"];

if($entidad=="citamedica" && $tipoUsuario=="Paciente")
	{
		$consulta="SELECT * FROM citamedica c, medico d, usuario p, cupo cu, tipocita t where c.institucion='{$institucion}' and c.idMedico=d.idMedico and c.idTipoCita=t.idTipoCita and c.idPaciente= '{$idUsuario}' and c.idPaciente=p.numeroDocumento and c.idCupo= cu.idCupo";
		$resultado_insert=mysqli_query($conexion,$consulta);
		while($registro=mysqli_fetch_assoc($resultado_insert))
		{	
			$idMedico= $registro['idMedico'];
			$sql="SELECT u.numeroDocumento as numeroMedico, u.sexoUsuario as sexomedico, u.correoUsuario as correomedico, u.fotoPerfilUsuario as fotomedico, u.nombreUsuario as nombremedico, u.telefonoUsuario as telefonomedico, m.descripcionMedico  FROM medico m, usuario u where m.idMedico='{$idMedico}' and m.idMedico=u.numeroDocumento";
			$resultado_sql= mysqli_query($conexion,$sql);
			if($registro_sql=mysqli_fetch_assoc($resultado_sql))
			{	
			
				$json['usuario'][]=array_merge($registro,$registro_sql);
			}else
			{
			    echo mysqli_error($conexion);

			}
		}
			
			
		
	}else
	{
		if($entidad=="citamedica" && $tipoUsuario=="Medico")
	{
		$consulta="SELECT * FROM citamedica c, medico d, usuario p, cupo cu, tipocita t where c.institucion='{$institucion}' and c.idMedico='{$idUsuario}' and c.idTipoCita=t.idTipoCita and c.idPaciente= p.numeroDocumento and c.idCupo= cu.idCupo and c.estadoCita='Aprobado' and d.idMedico=c.idMedico";
		$resultado_insert=mysqli_query($conexion,$consulta);
		while($registro=mysqli_fetch_assoc($resultado_insert))
		{	
			$json['usuario'][]=$registro;
		}
			
			
		
	}
	}
	

	


echo json_encode($json);	
mysqli_close($conexion);	
?>