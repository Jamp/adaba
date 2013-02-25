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
        $this->boton = "Registrar";
        $this->scouts = Load::model('datos_personales')->getDatosAdulto(Session::get('id'));
        $this->scouts->cargo_id = 0;
    }

    public function jovenes() {
    	$this->titulo = "Registro de Nuevo Jovén";
        $this->boton = "Registrar";
        $this->scouts = Load::model('datos_personales')->getDatosAdulto(Session::get('id'));
    }

    public function registrar() {
        if ( Input::hasPost('datos') ) {

            Load::model('datos_personales');
            $datos = new DatosPersonales( Input::post('datos') );
            $datos->begin();
            $id = $datos->registrar();

            if ( Input::post('tipo') == 1 && $id ) {
                // Datos Jóvenes
                Load::model('datos_jovenes');
                Load::model('datos_representante');
                $jovenes = Input::post('scouts');
                $rep1 = Input::post('rep1');
                $rep2 = Input::post('rep2');

                $datosJovenes = new DatosJovenes($jovenes);
                $rsj = $datosJovenes->vincular($id);
                $datosRepresentante1 = new DatosRepresentante($rep1);
                $rsp1 = $rsj && $datosRepresentante1->vincular($id);
                $datosRepresentante2 = new DatosRepresentante($rep2);
                $rsp2 =  $rsp1 && $datosRepresentante2->vincular($id);

                if ( $rsp2 ) {
                    $datos->commit();
                    Flash::valid('Jovén Registrado Correctamente');
                } else {
                    $datos->rollback();
                    View::select('jovenes');
                    Flash::error('Error al Registrar Jovén');
                }
            }  elseif ( Input::post('tipo') == 2 && $id ) {
                Load::model('datos_adultos');
                Load::model('datos_adultos_scouts');
                $adulto = Input::post('adulto');
                $scout = Input::post('scouts');

                $datosAdultos = new DatosAdultos($adulto);
                $rsa = $datosAdultos->vincular($id);
                $datosScouts = new DatosAdultosScouts($scout);
                $rss = $datosScouts->vincular($id);

                if ( $rsa && $rss ) {
                    $datos->commit();
                    Flash::valid('Adultos Registrado Correctamente');
                } else {
                    $datos->rollback();
                    View::select('adultos');
                    Flash::error('Error al Registrar Adulto');
                }
            } else{
                $datos->rollback();
                /**
                 * FIXME: Cambiar esto por volver al anterior, en vez de ver el tipo y llamar a la vista
                */
                if ( Input::post('tipo') == 1 ) {
                    View::select('jovenes');
                } else {
                    View::select('adultos');
                }
                Flash::error('Error al Registrar Datos Personales');
            }

            // print "<pre>";
            // print_r($_POST);
            // print "</pre>";
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
