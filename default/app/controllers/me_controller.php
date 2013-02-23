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
        View::select('../registro/adultos');
        $datos = Load::model('datos_personales')->getDatosAdulto(Session::get('id'));

        /* Datos Personales */
        // $this->primer_nombre = $datos->primer_nombre;
        // $this->segundo_nombre = $datos->segundo_nombre;
        // $this->primer_apellido = $datos->primer_apellido;
        // $this->segundo_apellido = $datos->segundo_apellido;
        // $this->cedula = $datos->cedula;
        // $this->fecha_nacimiento = $datos->fecha_nacimiento;
        // $this->nacionalidad = $datos->nacionalidad;
        // $this->tipo_sangre = $datos->tipo_sangre;
        // $this->grado_instruccion = $datos->grado_instruccion;
        // $this->religion = $datos->religion;
        // $this->sexo = $datos->sexo;
        // $this->ocupacion = $datos->ocupacion;
        // $this->lugar_nacimiento = $datos->lugar_nacimiento;
        // $this->telefono = $datos->telefono;
        // $this->celular = $datos->celular;
        // $this->email = $datos->email;
        /* Datos Personales */

        /* Datos Adultos */
        // $this->estado_civil = $datos->estado_civil;
        // $this->lugar_trabajo = $datos->lugar_trabajo;
        // $this->telefono_trabajo = $datos->telefono_trabajo;
        // $this->fax_trabajo = $datos->fax_trabajo;
        // $this->email_trabajo = $datos->email_trabajo;
        /* Datos Adultos */

        /* Datos Adultos Scouts */
        // $this->credencial = $datos->credencial;
        // $this->fecha_promesa = $datos->fecha_promesa;
        /* Datos Adultos Scouts */
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
