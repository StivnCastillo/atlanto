<?php 

class Rol_model extends CI_Model {

	private $tabla = 'rol';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    //Guarda datos de usuario
    function save($datos) {
        $this->db->insert($this->db->dbprefix($tabla), $datos);
        return $this->db->insert_id();
    }

    //Traer permisos
    function get_permisos($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($tabla));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }        
    }    
}


