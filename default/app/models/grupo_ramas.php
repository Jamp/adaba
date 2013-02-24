<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class GrupoRamas extends ActiveRecord {
    protected $logger = True;

    public function initialize() {
    }

    public function crearRama($idGrupo, $idRama) {
    	$this->grupo_id = $idGrupo;
    	$this->ramas_id = $idRama;
    	return $this->create();
    }

}