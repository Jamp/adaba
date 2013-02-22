<?php


class EstructuraController extends AppController {

	const ADMINISTRADOR = 1;
    const NACIONAL = 2;
    const REGIONAL = 3;
    const DISTRITAL = 4;
    const GRUPAL = 5;
    const UNIDAD = 6;
    const AGRUPACIONES = 7;

	public function before_filter() {
		if ( !Auth::is_valid() ) {
			Router::redirect('/logout/');
		}
	}

	public function index($nivel, $tipo = NULL ) {
		$cargo = Session::get('cargo');
		$poder = Session::get('poder');
		if( ( $cargo['nivel'] > $nivel && $poder['nivel'] > $nivel ) && Auth::is_valid() ){
			Flash::error('No posee permiso para acceder a esta función');
			Router::redirect('bienvenida/');
			return;
		}

		$this->titulo = "Estructura";

		if ( is_Null($tipo) ) {
			$id_area = $cargo['alcance_id'];
			$this->volver = "";
		} else {
			$id_area = $tipo;
			$this->volver = '<a href="javascript:history.back(1)">Volver Atrás</a>';
		}

		$this->h1 = "Nivel: " . ucfirst($cargo['nivel_estructura']);
		$this->h2 = "Seccion: " . ucfirst($cargo['alcance']);

		$opciones = array(
			'Ver' => 'estructura/' . ( $nivel + 1 )
			);

		switch ($nivel) {
			case self::REGIONAL:
				$model = 'distrito';
				$method = 'gridDistrito';
				break;
			case self::DISTRITAL:
				$model = 'grupo';
				$method = 'getGrupos';
				$opciones['Modificar'] = '#';
				$opciones['GPO'] = 'generar_gpo/';
				break;
			case self::GRUPAL:
				$model = 'ramas';
				$method = 'getRamas';
				break;
			case self::UNIDAD:
				$model = 'agrupaciones';
				$method = 'getAgrupaciones';
				break;

			default:
				$rs = NULL;
		}

		$modelo = array(
			$model,
			$method,
			$id_area
		);

		Utils::grid($modelo, True, $opciones);
	}
}

?>
