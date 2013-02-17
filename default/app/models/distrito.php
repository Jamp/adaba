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
    		`distrito`.`nombre` AS Nombre, 
    		sum( `grupo`.`estatus` ) AS Grupos,
            sum( `datos_jovenes`.`estatus` ) AS Jovenes
    	FROM `distrito`
    	INNER JOIN `grupo` ON `distrito`.`id` = `grupo`.`distrito_id`
        LEFT JOIN `datos_jovenes` ON `distrito`.`id` = `datos_jovenes`.`distrito_id`
    	WHERE 
    	( `grupo`.`estatus` = 1 AND `distrito`.`estatus` = 1 )
    	AND 
    	`distrito`.`region_id` = $idregion
    	GROUP BY `distrito`.`id` ";

    	return $this->find_all_by_sql($sql);
    }

}
?>