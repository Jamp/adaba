<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class RegistroController extends AppController
{

    ## Filtro de seguridad ##
    protected function before_filter() {
        if ( !Auth::is_valid() ) {
            Router::redirect('/logout/');
        }
    }
    ## Filtro de seguridad ##

    public function adultos() {
    	$this->titulo = "Registro de Nuevo Adultos";

        /* Datos Personales */
        $this->primer_nombre = "";
        $this->segundo_nombre = "";
        $this->primer_apellido = "";
        $this->segundo_apellido = "";
        $this->cedula = "";
        $this->fecha_nacimiento = "";
        $this->nacionalidad = "";
        $this->tipo_sangre = "";
        $this->grado_instruccion = "";
        $this->religion = "";
        $this->sexo = "";
        $this->ocupacion = "";
        $this->lugar_nacimiento = "";
        $this->telefono = "";
        $this->celular = "";
        $this->email = "";
        /* Datos Personales */

        /* Datos Adultos */
        $this->estado_civil = "";
        $this->lugar_trabajo = "";
        $this->telefono_trabajo = "";
        $this->fax_trabajo = "";
        $this->email_trabajo = "";
        /* Datos Adultos */

        /* Datos Adultos Scouts */
        $this->credencial = "";
        $this->fecha_promesa = "";
        /* Datos Adultos Scouts */

    }

    public function jovenes() {
    	$this->titulo = "Registro de Nuevo Jovén";

        /* Datos Personales */
        $this->primer_nombre = "";
        $this->segundo_nombre = "";
        $this->primer_apellido = "";
        $this->segundo_apellido = "";
        $this->cedula = "";
        $this->fecha_nacimiento = "";
        $this->nacionalidad = "";
        $this->tipo_sangre = "";
        $this->grado_instruccion = "";
        $this->religion = "";
        $this->sexo = "";
        $this->ocupacion = "";
        $this->lugar_nacimiento = "";
        $this->telefono = "";
        $this->celular = "";
        $this->email = "";
        /* Datos Personales */

    }

    public function registrar() {
        if ( Input::hasPost('datos') ) {
            print_r($_POST);
            //Load::model('datos_personales');
            //$datos = new DatosPersonales( Input::post('datos') );
/*
    [nombre_rep_1] => Carmen de Marval
    [cedula_rep_1] => 9580394
    [religion_rep_1] => 7
    [instruccion_rep_1] => 1
    [ocupacion_rep_1] => 1
    [telefono_rep_1] => 02695116112
    [celular_rep_1] => 04268550000
    [email_rep_1] => cmarval@gmail.com
    [fax_rep_1] => 02695116112
    [direccion_rep_1] => Calle Bolivar
    [nombre_rep_2] =>
    [cedula_rep_2] =>
    [religion_rep_2] => 0
    [instruccion_rep_2] => 0
    [ocupacion_rep_2] => 0
    [telefono_rep_2] =>
    [celular_rep_2] =>
    [email_rep_2] =>
    [fax_rep_2] =>
    [direccion_rep_2] =>
    [distrito] => 1
    [ramas] => 14
    [fecha_ingreso] => 03/02/2000
    [grupo] => 1
    [agrupacion] => 0
    [fecha_promesa] => 03/03/2000
    */
        }
    }

    /* Controladores Asincronos */

    public function getGrupos($idDistrito = '') {
        $salida = array('status' => 'ERROR');
        if ( $idDistrito != '' ) {
            $grupos = Load::model('grupo')->getGrupos($idDistrito);
            if ( $grupos ) $salida['status'] = "OK";
            $salida['grupos'] = $grupos;
        }
        View::template(NULL);
        View::response('json');
        echo json_encode($salida);
    }

    public function getRamas($idGrupo = '') {
        $salida = array('status' => 'ERROR');
        if ( $idGrupo != '' ) {
            $ramas = Load::model('ramas')->getRamas($idGrupo);
            if ( $ramas ) $salida['status'] = "OK";
            $salida['ramas'] = $ramas;
        }
        View::template(NULL);
        View::response('json');
        echo json_encode($salida);
    }

    public function getAgrupaciones($idRama = '') {
        $salida = array('status' => 'ERROR');
        if ( $idRama != '' ) {
            $ramas = Load::model('ramas')->getGrupos($idDistrito);
            if ( $grupos ) $salida['status'] = "OK";
            $salida['grupos'] = $grupos;
        }
        View::template(NULL);
        View::response('json');
        echo json_encode($salida);
    }

}
