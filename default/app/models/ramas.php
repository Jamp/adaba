<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class Ramas extends ActiveRecord {
	protected $logger = True;

    public function initialize() {
    }

    public function getRamas($idgrupo, $sexo = NULL, $edad = NULL) {
    	$sexo = ( is_null($sexo) )? '' : "AND sexo = $sexo";
    	$edad = ( is_null($edad) )? '' : "AND ( edad_minima <= $edad AND edad_maxima >= $edad )";
    	$sql = "SELECT `ramas`.`id` AS id, `ramas`.`nombre` AS nombre
		FROM `grupo`
		INNER JOIN `grupo_ramas`ON `grupo`.`id` = `grupo_ramas`.`grupo_id`
		INNER JOIN `ramas` ON `grupo_ramas`.`ramas_id` = `ramas`.`id`
		WHERE
		`grupo`.`id` =  $idgrupo
		$sexo
		$edad
		AND
		`grupo`.`estatus` = 1";

		return $this->find_all_by_sql($sql);
    }

}
?>