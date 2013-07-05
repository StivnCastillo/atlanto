<?php 

class Cargo_model extends CI_Model {
	private $tabla = 'cargo';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    //Guarda datos de cargo
    function save($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
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

    //Elimina un cargo
    function delete($id_cargo) {
        $this->db->where('id', $id_cargo);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }
}


