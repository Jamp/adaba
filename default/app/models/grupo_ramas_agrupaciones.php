<?php
/**
 * Descripcion de grupo_ramas_agrupaciones
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class GrupoRamasAgrupaciones extends ActiveRecord {
    protected $logger = True;

    public function initialize() {
    }

    public function crearNuevo($idGrupoRamas, $idRama) {
    	$this->grupo_ramas_id = $idGrupoRamas;
    	$this->agrupaciones_id = $idRama;

    	return $this->create();
    }
}
?>