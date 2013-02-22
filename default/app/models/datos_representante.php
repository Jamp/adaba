<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class DatosRepresentante extends ActiveRecord {
	protected $logger = True;

	public function vincular($idpersonal) {
		$this->datos_personales_id = $idpersonal;

		return $this->save();
	}

	public function actualizar() {
		return $this->update();
	}

}
?>