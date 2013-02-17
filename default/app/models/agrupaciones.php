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
    	$this->find("ramas_id = $id AND estatus = 1", 'columns: id, nombre');
    }

}
?>