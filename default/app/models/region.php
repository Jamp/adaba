<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class Region extends ActiveRecord {
	protected $logger = True;

    public function initialize() {
    }

    public function getRegiones($id = "") {
    	return $this->find($id);
    }

}
?>