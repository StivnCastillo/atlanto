<?php 

class Departamento_model extends CI_Model {
	private $tabla = 'departamento';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    //Guarda datos de la ubicacion
    function save($datos) {
        $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        return $this->db->insert_id();
    }

    //Traer permisos
    function get_todos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }        
    }

    function buscar($valor){
    	$query = $this->db->query("SELECT id, nombre FROM ".$this->db->dbprefix($this->tabla)." WHERE nombre LIKE '%".$valor."%'");
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
}


