<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class IndexController extends AppController
{

    ## Filtro de seguridad ##
    protected function before_filter() {
        if ( !Auth::is_valid() ) {
            Router::redirect('/logout/');
        }
    }
    ## Filtro de seguridad ##

    public function index() {
    	Load::lib('auth');
    	if ( !Auth::is_valid() ) {
    		Router::redirect('login');
    	}

    }

    public function bienvenida() {

    }

}
