<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class distrito extends ActiveRecord {


    public function initialize() {
    }

    public function getDistritos($idregion) {
    	return $this->find("region_id =  $idregion AND estatus = 1", 'columns: id, nombre');
    }

}
?>