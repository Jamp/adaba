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
            /*
            Load::model('datos_personales');
            $datos = new DatosPersonales( Input::post('datos') );
            $id = $datos->registrar();

            if ( Input::post('tipo') == 1 ) {
                // Datos Jóvenes
                Load::model('datos_jovenes');
                Load::model('datos_representante');
                $jovenes = Input::post('scouts');
                $rep1 = Input::post('rep1');
                $rep2 = Input::post('rep2');

                $datosJovenes = new DatosJovenes($jovenes);
                $rsj = $datosJovenes->vincular($id);
                $datosRepresentante1 = new DatosRepresentante($rep1);
                $rsp1 = $datosRepresentante1->vincular($id);
                $datosRepresentante2 = new DatosRepresentante($rep2);
                $rsp2 = $datosRepresentante2->vincular($id);
                Flash::valid('Jovén Registrado Correctamente');
            } else {
                Load::model('datos_adultos');
                Load::model('datos_adultos');


                Flash::valid('Adultos Registrado Correctamente');
            }

*/
            // print "ID -> " .$datos->registrar();
            print "<pre>";
            print_r($_POST);
            print "</pre>";
/*
Array
(
    [datos] => Array
        (
            [primer_nombre] => Jeferson
            [primer_apellido] => Marval
            [cedula] => 250105979
            [nacionalidad] => 19
            [grado_instruccion] => 24
            [religion] => 5
            [sexo] => 1
            [telefono] => 02695116112
            [segundo_nombre] => Franyer
            [segundo_apellido] => Pereira
            [fecha_nacimiento] => 30/01/1996
            [tipo_sangre] => 4
            [ocupacion] => 40
            [lugar_nacimiento] => Punto Fijo
            [celular] => 04126561533
            [email] => jmfp1996@gmail.com
            [direccion] => Intercomunal Alí Primera, Vía Judibana, Calle Bolivar con 2da Tranversal, Casa 151509
        )

    [scouts] => Array
        (
            [lugar_estudio_trabajo] => IUTIRLA
            [tipo_estudio] => 1
            [pais_id] =>
            [distrito_id] => 1
            [grupo_ramas_id] => 6
            [fecha_ingreso] =>
            [grupo_id] => 1
            [grupo_ramas_agrupaciones_id] => 0
            [fecha_promesa] =>
        )

    [rep1] => Array
        (
            [nombre] => Carmen de Marval
            [nacionalidad] => 19
            [cedula] => 9580394
            [sangre] => 4
            [religion] => 5
            [grado_instruccion] => 0
            [ocupacion] => 36
            [telefono] => 02695116112
            [celular] => 04262631070
            [email] =>
            [fax] =>
            [direccion] =>
        )

    [rep2] => Array
        (
            [nombre] =>
            [nacionalidad] => 19
            [cedula] =>
            [sangre] => 4
            [religion] => 5
            [grado_instruccion] => 0
            [ocupacion] => 0
            [telefono] => 02695116112
            [celular] => 04126903543
            [email] => fmarval.rodriguez@gmail.com
            [fax] =>
            [direccion] => Los Semerrucos
        )

)
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

    public function getRamas($idGrupo = '', $sexo = NULL, $fecha = NULL) {
        $edad = ( is_null($fecha) ) ? NULL : (int)(( time() - strtotime($fecha) )/31556926);
        $salida = array('status' => 'ERROR');
        if ( $idGrupo != '' ) {
            $ramas = Load::model('ramas')->getRamas($idGrupo, $sexo, $edad);
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
            $agrupaciones = Load::model('agrupaciones')->getAgrupaciones($idRama);
            if ( $agrupaciones ) $salida['status'] = "OK";
            $salida['agrupaciones'] = $agrupaciones;
        }
        View::template(NULL);
        View::response('json');
        echo json_encode($salida);
    }

    public function getCargos($codigo) {
        $salida = array('status' => 'ERROR');
        $c = explode("-", $codigo);
        $cargos = Load::model('cargo')->getCargos($c[0], $c[1], $c[2]);
        if ($cargos) {
            $salida['status'] = "OK";
            $salida['cargos'] = $cargos;
        }
        View::template(NULL);
        View::response('json');
        echo json_encode($salida);
    }

    public function getCargoUnidad($region, $distrito, $grupo, $unidad) {

    }
}
