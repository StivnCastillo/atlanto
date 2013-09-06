<?php 

class quejas_model extends CI_Model {
	private $tabla = 'queja';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_todos() {
        $this->db->order_by("id", "desc"); 
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }        
    }

    function get($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }

    function save($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }

    function update($id, $datos) {
        $this->db->where('id', $id);
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }
}