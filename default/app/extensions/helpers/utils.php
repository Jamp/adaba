<?php

/**
 * Conjunto de Helpers para operaciones varias
 * <code>
 * - ***
 * </code>
 *
 * @package helpers
 * @author jamp
 * @version 0.1
 *
 */
class Utils {

	public static function cargo($idCargo) {
		$salida = array();
		$cargo = Load::model('cargo')->getCargo($idCargo);

		$nivel_binario = ($cargo->id != 0)? "1" : "0";
		$nivel_binario .= ($cargo->pais_id != 0)? "1" : "0";
		$nivel_binario .= ($cargo->region_id != 0)? "1" : "0";
		$nivel_binario .= ($cargo->distrito_id != 0)? "1" : "0";
		$nivel_binario .= ($cargo->grupo_id != 0)? "1" : "0";
		$nivel_binario .= ($cargo->ramas_id != 0)? "1" : "0";

		/**
		* 0000000 // No Aplica
		* 1000000 // Administrador
		* 1100000 // Nacional
		* 1110000 // Regional
		* 1111000 // Distrital
		* 1111100 // Grupo
		* 1111110 // Unidad
		*/
		switch ($nivel_binario) {
			case '100000':
				$alcance = "No Aplica";
				$alcance_id = False;
				$nivel_nombre = "Administrador";
				$nivel = 1;
				break;
			case '110000':
				$alcance_id = $cargo->pais_id;
				$referencia = Load::model('pais')->find_first($alcance_id);
				$alcance = $referencia->nombre;
				$nivel_nombre = "Nacional";
				$nivel = 2;
				break;
			case '111000':
				$alcance_id = $cargo->region_id;
				$referencia = Load::model('region')->find_first($alcance_id);
				$alcance = $referencia->nombre;
				$nivel_nombre = "Regional";
				$nivel = 3;
				break;
			case '111100':
				$alcance_id = $cargo->distrito_id;
				$referencia = Load::model('distrito')->find_first($alcance_id);
				$alcance = $referencia->nombre;
				$nivel_nombre = "Distrital";
				$nivel = 4;
				break;
			case '111110':
				$alcance_id = $cargo->grupo_id;
				$referencia = Load::model('grupo')->find_first($alcance_id);
				$alcance = $referencia->nombre;
				$nivel_nombre = "Grupo";
				$nivel = 5;
				break;
			case '111111':
				$alcance_id = $cargo->ramas_id;
				$referencia = Load::model('rama')->find_first($alcance_id);
				$alcance = $referencia->nombre;
				$nivel_nombre = "Unidad";
				$nivel = 6;
				break;

			default:
				$alcance_id = False;
				$alcance = "Alcance Invalido";
				$nivel_nombre = "Nivel Invalido";
				$nivel = False;
				break;
		}

		$salida['binario'] = "$nivel_binario";
		$salida['id'] = $cargo->id;
		$salida['nombre'] = $cargo->nombre;
		$salida['nivel'] = $nivel;
		$salida['nivel_estructura'] = $nivel_nombre;
		$salida['alcance_id'] = $alcance_id;
		$salida['alcance'] = $alcance;

		return $salida;

	}


	/**
	 * Helpers para grid de datos segun un resultado de consulta
	 * 
	 * FIXME: Eliminar Result como parametros a recibir y cambiarlo por un Array
	 * 
	 * @var $modelo Array/Result Datos del Modelo, ejem: array($model, $method, $arg)
	 * @var $opciones Boolean Columnas de Opciones
	 * @var $arrayOpciones Array Lista de Opciones, ejem: array('Ver' => '/registro/ver/2/', 'Modificar' => '/registro/ver/2/' )
	 */
	public static function grid($modelo, $opciones = False, $arrayOpciones = NULL){

		// $elementos = get_object_vars($rs);
		print "<table>\r\n\t<tr>\r\n";
		if (!$modelo) {
			print "\t\t<td class=\"center\">Vacío</td>\r\n\t</tr>\r\n</table>\r\n";
			return;
		}

		$header = False;
		$registro = 1;
		$numOpciones = count($arrayOpciones);
		foreach ($modelo as $elemento) {
			// Imprimir Cabecera //
			$elementos = array_keys( get_object_vars($elemento) );

			$first = 0;
			$current = 0;
			$last = count($elementos) - 1;
			if ( !$header ) {
				foreach ($elementos as $key) {
					if ( $current == $first ) {
						print "\t\t<th>ID</th>\r\n";	
					} else {
						print "\t\t<th>" . ucfirst($key) . "</th>\r\n";
					}
					if ( $opciones && $current == $last ) print "\t\t<th colspan=\"$numOpciones\">Opciones</th>\r\n";
					$current++;
				}
				print "\t<tr>\r\n";
				$header = True;
			}
			// Imprimir Cabecera //

			// Imprimir Elementos //
			$first = 0;
			$current = 0;
			$last = count($elementos) - 1;
			foreach ($elementos as $key) {
				if ( $current == $first ) {
					print "\t<tr>\r\n";
					print "\t\t<td class=\"center\">" . $registro . "</td>\r\n";
				}
				if ( $key != "id" ) print "\t\t<td>" . $elemento->$key . "</td>\r\n";
				if ( $opciones && $current == $last ) {
					foreach ($arrayOpciones as $texto => $link) {
						$link .= ( substr($link, -1, 1) == '/' ) ? '' : '/';
						print "\t\t<td class=\"center\">" . Html::link( $link . $elemento->id, $texto) . "</td>\r\n";
					}
				}
				if ( $current == $last ) print "\t</tr>\r\n";
				$current++;
			}
			$registro++;
			// Imprimir Elementos //
		}
		print "</table>\r\n";

	}

}