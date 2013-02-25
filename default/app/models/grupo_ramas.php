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

    public function after_create() {
    	// Caso Especial, los Clanes no tienen pequeñas agrupaciones
    	// Asi que las agrupaciones de los clanes apunta a 0(No aplica)
    	if ( $this->ramas_id = 5 || $this->ramas_id = 6 ) {
    		Load::model('grupo_ramas_agrupaciones');
    		$agrupaciones = new GrupoRamasAgrupaciones();
    		$agrupaciones->crearNuevo($this->id, $this->ramas_id);
    	}
    }


}