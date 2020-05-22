
<?php
$txt='[{"aniosExperiencia":"5","cuposAreaTrabajo":[{"disponible":"nodisponible","fecha":"1:25","idCupo":"1","lugar":"Lugar:"},{"disponible":"disponible","fecha":"4:47","idCupo":"2","lugar":"hhh"}],"tipoCita":{"detalleTipoCita":"jskskks","idTipo":"5","nombreTipoCita":"no sé","urlImagen":"imagenes/noséElrosario.jpg"}},{"aniosExperiencia":"13","cuposAreaTrabajo":[{"disponible":"disponible","fecha":"4:47","idCupo":"2","lugar":"hhh"},{"disponible":"nodisponible","fecha":"10:19","idCupo":"3","lugar":"salab2"}],"tipoCita":{"detalleTipoCita":"jsjsjs","idTipo":"6","nombreTipoCita":"post","urlImagen":"imagenes/postElrosario.jpg"}}]';
$var = json_decode($txt,true);
//var_dump($var);

foreach ($var as &$valor) {
	echo('<pre>');
	print_r($valor);
	echo('</pre>');
	echo "años exp:".$valor["aniosExperiencia"];
	foreach($valor["cuposAreaTrabajo"] as $cupo){
		echo "Idcupo:".$cupo["idCupo"];
	}
	echo $valor["tipoCita"]["idTipo"];
}
// $array ahora es array(2, 4, 6, 8)
/*unset($valor); // rompe la referencia con el último elemento

switch(json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - Sin errores';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Excedido tamaño máximo de la pila';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Desbordamiento de buffer o los modos no coinciden';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Encontrado carácter de control no esperado';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Error de sintaxis, JSON mal formado';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Caracteres UTF-8 malformados, posiblemente están mal codificados';
        break;
        default:
            echo ' - Error desconocido';
        break;
    }*/