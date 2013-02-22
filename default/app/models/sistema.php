<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class Sistema extends ActiveRecord {
	protected $logger = True;

    public function initialize() {
        $this->belongs_to('datos_personales', 'model: datos_personales', 'fk: datos_personales_id');
        // $this->validates_email_in('email', 'message: Debe colocar un email valido');
        //$this->validates_length_of('clave', 16, 8);
    }

}
?>