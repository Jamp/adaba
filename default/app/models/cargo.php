<?php
/**
 * Descripcion de Personal
 * Modelo del Framework KumbiaPHP
 *
 * @author jamp
 * @version 0.1
 *
 */
class cargo extends ActiveRecord {
    protected $logger = True;

    public function initialize() {
    }

    public function getCargo($id) {
        $sql = "SELECT
        `cargo`.`id`, `cargo_nombre`.`nombre`, `pais_id`, `region_id`, `distrito_id`, `grupo_id`, `ramas_id`
        FROM `cargo`
        INNER JOIN `ramas` ON `cargo`.`ramas_id` = `ramas`.`id`
        INNER JOIN `cargo_nombre` ON `cargo`.`cargo_nombre_id` = `cargo_nombre`.`id`
        WHERE
        `cargo`.`id` = $id";
    	return $this->find_by_sql($sql);
    }

    public function getCargos($idRegion, $idDistrito, $idGrupo) {
    	$sql = "SELECT
        `cargo`.`id` AS id, concat(`cargo_nombre`.`nombre`, ' ', `ramas`.`nombre`) AS nombre
        FROM `cargo`
        INNER JOIN `ramas` ON `cargo`.`ramas_id` = `ramas`.`id`
        INNER JOIN `cargo_nombre` ON `cargo`.`cargo_nombre_id` = `cargo_nombre`.`id`
    	WHERE
    	`pais_id` = 1
  		AND `region_id` = $idRegion
  		AND `distrito_id` = $idDistrito
  		AND `grupo_id` = $idGrupo";
        return $this->find_all_by_sql($sql);
    }

    public function crearCargo($idRegion, $idDistrito, $idGrupo, $idRama, $idNombreCargo) {
        $this->pais_id = 1;
        $this->region_id = $idRegion;
        $this->distrito_id = $idDistrito;
        $this->grupo_id = $idGrupo;
        $this->ramas_id = $idRama;
        $this->cargo_nombre_id = $idNombreCargo;
        return $this->create();
    }
  //   public function getCargos($nombre) {
  //   	$sql = "SELECT
  //   	`cargo`.`id` AS id, `cargo`.`nombre` AS nombre
  //   	FROM `cargo`
  //   	INNER JOIN `ramas` ON `cargo`.`ramas_id` = `ramas`.`id`
  //   	WHERE
		// AND `cargo`.`grupo_id` = $idGrupo
		// AND `cargo`.`nombre` = '$nombre'";
  //   	return $this->find_all_by_sql($sql);
  //   }

}
?>