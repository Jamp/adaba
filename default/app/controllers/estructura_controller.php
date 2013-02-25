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
			'Ver' => 'estructura/nivel/' . ( $nivel + 1 )
			);

		switch ($nivel) {
			case self::REGIONAL:
				$model = 'distrito';
				$method = 'gridDistrito';
				break;
			case self::DISTRITAL:
				$model = 'grupo';
				$method = 'getGrupos';
				$opciones['Modificar'] = 'estructura/grupo/';
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

	public function grupo($id = NULL) {
		$this->boton = 'Crear';
		$this->scouts = Load::model('datos_personales')->getDatosAdulto(Session::get('id'));

		if ( $id ) {
			Load::model('grupo');
			$this->boton = 'Modificar';
			$grupo = new Grupo();
			$this->datos = $grupo->find_first($id);
			// print_r($this->datos);
		}

		if ( Input::hasPost('datos') ) {
			Load::model('grupo');
			$post = Input::post('datos');
			$rs = new Grupo($post);
			if ( $post['id'] ) {
				if ( $rs->actualizarGrupo() ){
					Flash::valid('Grupo Actualizado con éxito');
				} else {
					Flash::error('Error al Intentar Actualizar la Información del grupo');
				}
			} else {
				$rs->begin();
				$distrito = $post['distrito_id'];

				$grupo = $rs->crearGrupo();
				if ( $grupo ) {
					$atomic = True;
					// Ramas
					Load::model('grupo_ramas');
					$ramas = new GrupoRamas();
					$atomic = $atomic && $ramas->crearRama($grupo, 1); // Manada Femenina
					$atomic = $atomic && $ramas->crearRama($grupo, 2); // Manada Masculina
					$atomic = $atomic && $ramas->crearRama($grupo, 3); // Tropa Femenina
					$atomic = $atomic && $ramas->crearRama($grupo, 4); // Tropa Masculina
					$atomic = $atomic && $ramas->crearRama($grupo, 5); // Clan Femenino
					$atomic = $atomic && $ramas->crearRama($grupo, 6); // Clan Masculino

					// Cargos
					Load::model('cargo');
					$cargo = new Cargo(); //$i);
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, '0', 30); // Jefe de Grupo
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, '0', 31); // SubJefe de Grupo
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 5, 32); // Jefe de Unidad Clan Femenino
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 1, 32); // Jefe de Unidad Manada Femenina
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 4, 32); // Jefe de Unidad Tropa Masculina
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 3, 32); // Jefe de Unidad Tropa Femenina
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 6, 32); // Jefe de Unidad Clan Masculino
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 2, 32); // Jefe de Unidad Manada Masculina
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 6, 33); // SubJefe de Unidad Clan Masculino
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 2, 33); // SubJefe de Unidad Manada Masculina
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 5, 33); // SubJefe de Unidad Clan Femenino
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 1, 33); // SubJefe de Unidad Manada Femenina
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 4, 33); // SubJefe de Unidad Tropa Masculina
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 3, 33); // SubJefe de Unidad Tropa Femenina
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 3, 34); // Representante Tropa Femenina
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 6, 34); // Representante Clan Masculino
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 2, 34); // Representante Manada Masculina
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 5, 34); // Representante Clan Femenino
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 1, 34); // Representante Manada Femenina
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, 4, 34); // Representante Tropa Masculina
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, '0', 35); // Rep. de Institución Patrocinadora
					$atomic = $atomic && $cargo->crearCargo(1, $distrito, $grupo, '0', 36); // Adulto Colaborador

					if ( $atomic ) {
						$rs->commit();
						Flash::valid('Grupo Creado Exitosamente!!!');
					} else {
						$rs->rollback();
						Flash::error('Error al Crear el Grupo Nuevo');
					}

				} else {
					$rs->rollback();
					Flash::error('Hubo algún error al intentar crear el grupo');
				}
			}
		}
	}
}

?>
