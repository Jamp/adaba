<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class region extends ActiveRecord {


    public function initialize() {
    }

    public function getRegion() {
    	return $this->find();
    }

}
?>