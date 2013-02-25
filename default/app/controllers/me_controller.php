<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class MeController extends AppController
{

    ## Filtro de seguridad ##
    protected function before_filter() {
        if ( !Auth::is_valid() ) {
            Router::redirect('/logout/');
        }
    }
    ## Filtro de seguridad ##

    public function index() {
        $this->titulo = "Modificar Registro";
        $this->boton = "Actualizar";
        View::select('../registro/adultos');
        $this->datos = $this->adulto = $this->scouts = Load::model('datos_personales')->getDatosAdulto(Session::get('id'));
    }

    public function clave() {
        if ( Input::hasPost('datos') ) {
            $datos = Input::post('datos');
            $datos['datos_personales_id'] = Session::get('id');

            if ( $datos['clave'] == '' ) {
                Flash::error('La clave no puede estar vacía');
            } elseif ( strlen($datos['clave']) <= 4 && strlen($datos['clave']) >= 14 ) {
                Flash::error('La clave no puede ser menos a 4 ni mayor a 14');
            } elseif ( $datos['clave'] == $datos['reclave'] ) {
                Load::model('datos_adultos_scouts');
                $clave = new DatosAdultosScouts($datos);
                if( $clave->cambioClave()) {
                    Flash::valid('Clave Cambiada Exitosamente');
                } else {
                    Flash::error('No se pudo actualizar su clave');
                }
            } else {
                Flash::error('No son iguales las contraseñas');
            }
        }
    }

}
