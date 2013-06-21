<?php 

class Log_model extends CI_Model {

	private $tabla = 'log';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    //Guarda datos de usuario
    function save($datos) {
        $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        return $this->db->insert_id();
    }

    
}