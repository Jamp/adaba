<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class Agrupaciones extends ActiveRecord {


    public function initialize() {
    }

    public function getAgrupaciones($id) {
    	$sql = "SELECT `grupo_ramas_agrupaciones`.`id` AS id, `agrupaciones`.`nombre` AS nombre
		FROM `grupo_ramas_agrupaciones`
		INNER JOIN `grupo_ramas` ON `grupo_ramas_agrupaciones`.`grupo_ramas_id` = `grupo_ramas`.`id`
		INNER JOIN `agrupaciones` ON `grupo_ramas_agrupaciones`.`agrupaciones_id` = `agrupaciones`.`id`
		WHERE `grupo_ramas_agrupaciones`.`grupo_ramas_id` = $id";

		return $this->find_all_by_sql($sql);
    }

}
?>