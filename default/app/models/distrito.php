<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class Distrito extends ActiveRecord {


    public function initialize() {
    }

    public function getDistritos($idregion) {
    	return $this->find("region_id =  $idregion AND estatus = 1", 'columns: id, nombre');
    }

    public function gridDistrito($idregion) {
    	$sql = "SELECT 
    		`distrito`.`id` AS id, 
    		`distrito`.`nombre` AS nombre, 
    		COUNT( DISTINCT `grupo`.`id` ) AS grupos,
            COUNT( DISTINCT `datos_jovenes`.`datos_personales_id`) AS jovénes,
            COUNT( DISTINCT `datos_adultos_scouts`.`datos_personales_id`) AS adultos
    	FROM `distrito`
    	INNER JOIN `grupo` ON `distrito`.`id` = `grupo`.`distrito_id`
        INNER JOIN `cargo` ON `distrito`.`id` = `cargo`.`distrito_id`
        LEFT JOIN `datos_jovenes` ON `distrito`.`id` = `datos_jovenes`.`distrito_id` AND `datos_jovenes`.`estatus` = 1
        LEFT JOIN `datos_adultos_scouts` ON `datos_adultos_scouts`.`cargo_id` = `cargo`.`id` AND `datos_adultos_scouts`.`estatus` = 1
    	WHERE 
    	`grupo`.`estatus` = 1 
        AND 
        `distrito`.`estatus` = 1
    	AND 
    	`distrito`.`region_id` = $idregion
    	GROUP BY `distrito`.`id`";

    	return $this->find_all_by_sql($sql);
    }

}
?>