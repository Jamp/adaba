<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class DatosPersonales extends ActiveRecord {

    public function initialize() {
        // $this->belongs_to('datos_personales', 'model: datos_personales', 'fk: datos_personales_id');
        $this->validates_email_in('email', 'message: Debe colocar un correo electrónico válido');
        //$this->validates_length_of('clave', 16, 8);
        $this->logger = True;
    }

    public function login($email){
    	$busqueda = $this->find_first("email = '". $email . "'", 'columns:id');
    	$retorno = ( $busqueda )? $busqueda->id : 0 ;
    	return $retorno;
    }

    public function getNombreCompleto($id) {
    	$nombre = "No Existe";
    	$resultado = $this->find_first($id, 'columns:primer_nombre, segundo_nombre, primer_apellido, segundo_apellido');
    	if ($resultado) {
    		$segundo_nombre = ($resultado->segundo_nombre != "")? " " . substr($resultado->segundo_nombre,0,1) . ".": "";
			$segundo_apellido = ($resultado->segundo_apellido != "")? " " . substr($resultado->segundo_apellido,0,1) . ".": "";
			$nombre = $resultado->primer_nombre . $segundo_nombre . " " . $resultado->primer_apellido .$segundo_apellido;
    	}
    	return $nombre;
    }

    public function getEmail($id) {
    	$email = "No Existe";
    	$resultado = $this->find_first($id, 'columns:id');
    	return ($resultado)? $resultado->email: $email;
    }

    public function getDatosAdulto($id) {
        $sql = "SELECT datos_personales.id AS id, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, cedula, fecha_nacimiento, nacionalidad, tipo_sangre, grado_instruccion, religion, sexo, ocupacion, lugar_nacimiento, telefono, celular, email,

            -- Datos Adultos
            estado_civil, lugar_trabajo, telefono_trabajo, fax_trabajo, email_trabajo,

            -- Datos Adultos Scouts
            credencial, fecha_promesa

            FROM datos_personales
            INNER JOIN datos_adultos ON datos_personales.id = datos_adultos.datos_personales_id
            INNER JOIN datos_adultos_scouts ON datos_personales.id = datos_adultos_scouts.datos_personales_id
            WHERE `datos_personales`.`id` = $id";
            return $this->find_by_sql($sql);
    }


    public function registrar() {
        $rs = $this->save();

        return ( $rs ) ? $this->id : False;
    }

    public function after_save() {

    }
}
?>