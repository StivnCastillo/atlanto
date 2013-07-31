<?php 

class Tipo_model extends CI_Model {
	private $tabla_com = 'computador_tipo';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    //Guarda datos tipo computador
    function save_com($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla_com), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    //Traer datos tipo computador
    function get_com_todos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla_com));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }        
    }

    //Trae red segun parametros de $data
    function get_tipocom($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla_com));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }

    //Elimina
    function delete_com($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->db->dbprefix($this->tabla_com));
    }

    //Actualiza los datos del tipo
    function update_com($id, $datos) {
        $this->db->where('id', $id);
        return $this->db->update($this->db->dbprefix($this->tabla_com), $datos);
    }
}


