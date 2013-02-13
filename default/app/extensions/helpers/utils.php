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
		$nivel_binario .= ($cargo->agrupaciones_id != 0)? "1" : "0";

		/**
		* 0000000 // No Aplica
		* 1000000 // Administrador
		* 1100000 // Nacional
		* 1110000 // Regional
		* 1111000 // Distrital
		* 1111100 // Grupo
		* 1111110 // Unidad
		* 1111111 // Agrupaciones (Patrullas o Seisenas)
		*/
		switch ($nivel_binario) {
			case '1000000':
				$alcance = "No Aplica";
				$alcance_id = False;
				$nivel_nombre = "Administrador";
				$nivel = 1;
				break;
			case '1100000':
				$alcance_id = $cargo->pais_id;
				$referencia = Load::model('pais')->find_first($alcance_id);
				$alcance = $referencia->nombre;
				$nivel_nombre = "Nacional";
				$nivel = 2;
				break;
			case '1110000':
				$alcance_id = $cargo->region_id;
				$referencia = Load::model('region')->find_first($alcance_id);
				$alcance = $referencia->nombre;
				$nivel_nombre = "Regional";
				$nivel = 3;
				break;
			case '1111000':
				$alcance_id = $cargo->distrito_id;
				$referencia = Load::model('distrito')->find_first($alcance_id);
				$alcance = $referencia->nombre;
				$nivel_nombre = "Distrital";
				$nivel = 4;
				break;
			case '1111100':
				$alcance_id = $cargo->grupo_id;
				$referencia = Load::model('grupo')->find_first($alcance_id);
				$alcance = $referencia->nombre;
				$nivel_nombre = "Grupo";
				$nivel = 5;
				break;
			case '1111110':
				$alcance_id = $cargo->ramas_id;
				$referencia = Load::model('rama')->find_first($alcance_id);
				$alcance = $referencia->nombre;
				$nivel_nombre = "Unidad";
				$nivel = 6;
				break;
			case '1111111':
				$alcance_id = $cargo->agrupaciones_id;
				$referencia = Load::model('agrupacion')->find_first($alcance_id);
				$alcance = $referencia->nombre;
				$nivel_nombre = "Pequeña Agrupacion";
				$nivel = 7;
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

}