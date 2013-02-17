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

		$this->titulo = "Estructura";
		
		$cargo = Session::get('cargo');
		$id_area = ( is_Null($tipo) ) ? $cargo['alcance_id'] : $tipo;

		$this->h1 = "Nivel: " . ucfirst($cargo['nivel_estructura']);
		$this->h2 = "Seccion: " . ucfirst($cargo['alcance']);

		switch ($nivel) {
			case self::REGIONAL:
				Load::model('distrito');
				$distrito = new Distrito();
				$rs = $distrito->gridDistrito($id_area);
				break;
			case self::DISTRITAL:
				Load::model('grupo');
				$grupo = new Grupo();
				$rs = $grupo->getGrupos($id_area);
				break;

			case self::GRUPAL:
				Load::model('ramas');
				$unidad = new Ramas();
				$rs = $unidad->getRamas($id_area);
				break;
			case self::UNIDAD:
				Load::model('agrupaciones');
				$agrupaciones = new Agrupaciones();
				$rs = $agrupaciones->getAgrupaciones($id_area);
				break;
			
			default:
				$rs = NULL;
		}

		$opciones = array(
			'Ver' => 'estructura/' . ( $nivel + 1 ) ,
			'Modificar' => '#'
			);
		Utils::grid($rs, True, $opciones);
	}
}

?>
