<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class cargo extends ActiveRecord {


    public function initialize() {
    }

    public function getCargo($id) {
    	return $this->find_first($id);
    }
}
?>