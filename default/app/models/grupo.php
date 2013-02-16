<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class grupo extends ActiveRecord {


    public function initialize() {
    }

    public function getGrupos($idDistrito) {
    	return $this->find("distrito_id = $idDistrito AND estatus = 1", 'columns: id, nombre');
    }

}
?>