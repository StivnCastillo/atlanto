<?php 

class Tipo_model extends CI_Model {
    private $tabla_com = 'computador_tipo';
	private $tabla_so = 'sistema_tipo';

	function __construct() {
        parent::__construct();
    }
    
    function save_com($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla_com), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    function get_com_todos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla_com));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }        
    }

    function get_tipocom($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla_com));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }

    function delete_com($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->db->dbprefix($this->tabla_com));
    }

    function update_com($id, $datos) {
        $this->db->where('id', $id);
        return $this->db->update($this->db->dbprefix($this->tabla_com), $datos);
    }



    function save_so($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla_so), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    function get_so_todos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla_so));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }        
    }

    function get_tiposo($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla_so));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }

    function delete_so($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->db->dbprefix($this->tabla_so));
    }

    function update_so($id, $datos) {
        $this->db->where('id', $id);
        return $this->db->update($this->db->dbprefix($this->tabla_so), $datos);
    }
}


