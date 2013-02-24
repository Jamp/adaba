<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class Grupo extends ActiveRecord {
	protected $logger = True;

    public function initialize() {
    }

    public function getGrupos($idDistrito) {
    	return $this->find("distrito_id = $idDistrito AND estatus = 1", 'columns: id, nombre');
    }

    public function crearGrupo() {
    	return ( $this->create() ) ? $this->id : False;
    }

    public function actualizarGrupo() {
        // $d = explode('/', $this->fundacion_at);
    	// $this->fundacion_at = $d[2] . '-' . $d[1] . '-' . $d[0];
        $this->fundacion_at = strftime("%d/%m/%Y", strtotime($this->fundacion_at));
    	return $this->update();
    }

}
?>