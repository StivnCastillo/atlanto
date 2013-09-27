<?php 

class Historial_model extends CI_Model {
	private $tabla = 'historial';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    function save($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    function get_todos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }        
    }

    function get_historial($id_componente, $componente) {
        $query = $this->db->query("SELECT 
                ".$this->db->dbprefix($this->tabla).".*
                FROM ".$this->db->dbprefix($this->tabla)."                
                WHERE ".$this->db->dbprefix($this->tabla).".id_componente = ".$id_componente." AND ".$this->db->dbprefix($this->tabla).".componente = '".$componente."'
                ORDER BY fecha DESC
        ");
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function delete($id_cargo) {
        $this->db->where('id', $id_cargo);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }

    function update($id_usuario, $datos) {
        $this->db->where('id', $id_usuario);
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }
}


