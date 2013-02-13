<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class ramas extends ActiveRecord {


    public function initialize() {
    }

    public function getRamas($idgrupo) {
    	return $this->find("grupo_id =  $idgrupo AND estatus = 1", 'columns: id, nombre');
    }

}
?>