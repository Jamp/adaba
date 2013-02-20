<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class DatosJovenes extends ActiveRecord {

	public function vincular($idpersonal){
		$this->pais_id = 1;
        $this->region_id = 1;
        $this->estatus = 1;
        $this->datos_personales_id = $idpersonal;

        return $this->save();
	}

    public function actualizar(){
        	$this->id = $id;
        	$this->pais_id = 1;
            $this->region_id = 1;
            $this->estatus = 1;

            return $this->update();
	}

}
?>