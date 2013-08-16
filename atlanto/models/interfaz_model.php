<?php 

class Interfaz_model extends CI_Model {
    private $tabla_mon = 'monitor_interfaz';
	private $tabla_comp = 'componente_interfaz';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_mon_todos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla_mon));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }        
    }

    ///////////////////
    function get_comp_todos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla_comp));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }        
    }

}