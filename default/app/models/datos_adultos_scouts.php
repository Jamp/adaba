<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class DatosAdultosScouts extends ActiveRecord {
	protected $logger = True;

	public function vincular($idpersonal) {
		$this->datos_personales_id = $idpersonal;
		return $this->create();
	}

	public function cambioClave() {
		$clave = $this->clave;
		$rs = $this->find_first('datos_personales_id = ' . $this->datos_personales_id );
		$rs->clave = md5($clave);
		return $rs->update();
	}

}
?>