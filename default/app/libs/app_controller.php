<?php
/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

/**
 * Controlador principal que heredan los controladores
 *
 * Todas las controladores heredan de esta clase en un nivel superior
 * por lo tanto los metodos aqui definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 */

Load::lib('auth');
Load::lib('acl');

class AppController extends Controller
{

    public $acl;
    public $userRol = "";
    public $titulo = "";

    final protected function initialize() {


    		// @FIXME: Roles y Recursos Escrito Hardcodding
    		/* Inicio  de Roles */
   //          $this->acl = new Acl();
   //          // General
   //          $this->acl->add_role(new AclRole('')); //Visitante
   //          $this->acl->add_role(new AclRole('Administrador')); //Administrador

   //          // Region
   //          $this->acl->add_role(new AclRole('Comisionado Regional')); //Comisionado Regional
   //          $this->acl->add_role(new AclRole('Operaciones Regional')); //Operaciones Regional
   //          $this->acl->add_role(new AclRole('Asistente Operaciones Regional')); //Asistente Operaciones Regional
   //          $this->acl->add_role(new AclRole('Finanzas Regional')); //Finanzas Regional
   //          $this->acl->add_role(new AclRole('Asistente Finanzas Regional')); //Asistente Finanzas Regional
   //          $this->acl->add_role(new AclRole('Gestion Regional')); //Gestion Regional
   //          $this->acl->add_role(new AclRole('Asistente Gestion Regional')); //Asistente Gestion Regional
   //          $this->acl->add_role(new AclRole('RRAA Regional')); //RRAA Regional
   //          $this->acl->add_role(new AclRole('Asistente RRAA Regional')); //Asistente RRAA Regional
   //          $this->acl->add_role(new AclRole('Comunicaciones Regional')); //Comunicaciones Regional
   //          $this->acl->add_role(new AclRole('Asistente Comunicaciones Regional')); //Asistente Comunicaciones Regional
			// $this->acl->add_role(new AclRole('Programa de Jovenés Regional')); //Comunicaciones Regional
   //          $this->acl->add_role(new AclRole('Asistente de Programa de Jovenés Regional')); //Asistente Comunicaciones Regional
   //          $this->acl->add_role(new AclRole('Colaborador Regional')); //Colaborador Regional

   //          // Distrito
   //          $this->acl->add_role(new AclRole('Comisionado Distrital')); //Comisionado Distrital
   //          $this->acl->add_role(new AclRole('Operaciones Distrital')); //Operaciones Distrital
   //          $this->acl->add_role(new AclRole('Asistente Operaciones Distrital')); //Asistente Operaciones Distrital
   //          $this->acl->add_role(new AclRole('Finanzas Distrital')); //Finanzas Distrital
   //          $this->acl->add_role(new AclRole('Asistente Finanzas Distrital')); //Asistente Finanzas Distrital
   //          $this->acl->add_role(new AclRole('Gestion Distrital')); //Gestion Distrital
   //          $this->acl->add_role(new AclRole('Asistente Gestion Distrital')); //Asistente Gestion Distrital
   //          $this->acl->add_role(new AclRole('RRAA Distrital')); //RRAA Distrital
   //          $this->acl->add_role(new AclRole('Asistente RRAA Distrital')); //Asistente RRAA Distrital
   //          $this->acl->add_role(new AclRole('Gestion Distrital')); //Gestion Distrital
   //          $this->acl->add_role(new AclRole('Asistente Gestion Distrital')); //Asistente Gestion Distrital
   //          $this->acl->add_role(new AclRole('Comunicaciones Distrital')); //Comunicaciones Distrital
   //          $this->acl->add_role(new AclRole('Asistente Comunicaciones Distrital')); //Asistente Comunicaciones Distrital
   //          $this->acl->add_role(new AclRole('Colaborador Distrital')); //Colaborador Distrital

   //          // Grupo
   //          $this->acl->add_role(new AclRole('Jefe de Grupo')); //Jefe de Grupo
   //          $this->acl->add_role(new AclRole('SubJefe de Grupo')); //SubJefe de Grupo
   //          $this->acl->add_role(new AclRole('Jefe de Unidad')); //Jefe de Unidad
   //          $this->acl->add_role(new AclRole('SubJefe de Unidad')); //SubJefe de Unidad
   //          $this->acl->add_role(new AclRole('Colaborador de Grupo')); //Colaborador de Grupo
   //          /* Fin de Roles */

   //          /* Inicio de Recursos */
   //          $this->acl->add_resource(new AclResource("registro"), "jovenes", "adultos");
   //          /* Fin de Recursos */

   //          $this->acl->allow("", "registro", array("jovenes", "adultos"));
   //  		$this->acl->allow("Administrador", "registro", array("jovenes", "adultos"));


    }

    final protected function finalize()
    {

    }

}
