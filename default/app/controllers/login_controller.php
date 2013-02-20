<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class LoginController extends AppController
{
	private $auth = '';
    public function index() {
    	View::template('login');
    	// try {
	        if (Input::post('usuario')) {
	            Load::lib('auth');
	            Load::lib('acl');
	            Load::model('datos_personales');
	            $datos = new DatosPersonales();
	            $usuario = Input::post('usuario');
	            $login = $datos->login($usuario);

            	$clave = md5(Input::post('clave'));
            	$this->auth = new Auth('model', 'class: datos_adultos_scouts', "datos_personales_id: $login", "clave: $clave");
	            if ( !$this->auth->authenticate() ) {
	                Flash::error("Usuario o Contrase&ntilde;a es Invalida");
	            } else {
	                Session::set( 'id', $this->auth->get('datos_personales_id') );
	                Session::set( 'cargo', Utils::cargo($this->auth->get('cargo_id')) );
	                Session::set( 'poder', Utils::cargo($this->auth->get('poderes_id')) );
	                Router::redirect('bienvenida/');
	            }
	        }  elseif ( Auth::is_valid() ) {
	                Router::redirect('bienvenida/');
	        }
    	// } catch (Exception $exception) {
    	// 	Flash::error("Error Desconocido<br/>Consulte con el administrador");
    	// }
    }

    public function logout() {
        Auth::destroy_identity();
        Flash::info('Sesión Cerrada');
    	Router::toAction('index');
    }
}