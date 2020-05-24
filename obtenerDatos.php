<?PHP
$hostname_localhost="localhost";
$database_localhost="your_healthdb";
$username_localhost="root";
$password_localhost="";
$json=array();
$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$entidad=$_GET["entidad"];
$extra=$_GET["extra"];
$institucion=$_GET["institucion"];
if($entidad=="medico"){
	$consulta="SELECT * FROM usuario u , medico m, areastrabajo a where u.tipoUsuario='Medico' and u.institucion='{$institucion}' and m.idMedico=a.idMedico and a.idTipoCita= '{$extra}'";
	$resultado_insert=mysqli_query($conexion,$consulta);
	while($registro=mysqli_fetch_assoc($resultado_insert)){
	$json['usuario'][]=$registro;		
	}
	

}
else
{
	if($entidad=="cupo" && $extra!="")
	{	
		$consulta="SELECT c.idCupo, c.lugar,c.hora from cupo c, areatrabajo_cupo ac, areastrabajo ar where ar.idTipoCita='{$extra}' and ar.idMedico='{$institucion}' and ac.idareatrabajo=ar.idArea and c.idCupo=ac.idcupo";
		$resultado_insert=mysqli_query($conexion,$consulta);
		while($registro=mysqli_fetch_assoc($resultado_insert))
		{
		$json['usuario'][]=$registro;		
		}
	}
	else
	{
		if($entidad=="citamedica" && $extra!="")
		{
			$consulta="SELECT * FROM citamedica c, medico d, usuario p, cupo cu, tipocita t where c.institucion='{$institucion}' and c.estadoCita='{$extra}' and c.idMedico=d.idMedico and c.idTipoCita=t.idTipoCita and c.idPaciente= p.numeroDocumento and c.idCupo= cu.idCupo";
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
			if($entidad=="usuario" && $extra!="")
			{	
				if($extra=='Medico')
				{
					$consulta="SELECT * from usuario u, medico m WHERE u.tipoUsuario='Medico' and u.institucion='{$institucion}' and u.numeroDocumento=m.idMedico GROUP BY u.numeroDocumento";
					$resultado_insert=mysqli_query($conexion,$consulta);
					while($registro=mysqli_fetch_assoc($resultado_insert))
					{
					$json['usuario'][]=$registro;		
					}

					
				}else
				{
					$consulta="select * from {$entidad} where institucion='{$institucion}' and tipoUsuario='{$extra}';";
					$resultado_insert=mysqli_query($conexion,$consulta);
					while($registro=mysqli_fetch_assoc($resultado_insert))
					{
					$json['usuario'][]=$registro;		
					}
				}
			}else
			{	
			$consulta="select * from {$entidad} where institucion='{$institucion}';";
			$resultado_insert=mysqli_query($conexion,$consulta);
			while($registro=mysqli_fetch_assoc($resultado_insert))
			{
			$json['usuario'][]=$registro;		
			}
			}
			echo mysqli_error($conexion);
		}
	}
	
}

echo json_encode($json);	
mysqli_close($conexion);	
?>