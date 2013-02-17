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


    public function initialize() {
    }

    public function getRamas($idgrupo) {
    	return $this->find("grupo_id =  $idgrupo AND estatus = 1", 'columns: id, nombre');
    }

    public function gridRamas($idgrupo) {
    	$sql = "SELECT `ramas`.`id` AS id, `ramas`.`nombre` AS Nombre
		FROM `grupo` 
		INNER JOIN `grupo_ramas`ON `grupo`.`id` = `grupo_ramas`.`grupo_id`
		INNER JOIN `ramas` ON `grupo_ramas`.`ramas_id` = `ramas`.`id`
		WHERE
		`grupo`.`id` =  $idgrupo AND `grupo`.`estatus` = 1";

		return $this->find_all_by_sql($sql);
    }

}
?>