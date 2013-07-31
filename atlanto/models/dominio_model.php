<?php 

class Dominio_model extends CI_Model {
	private $tabla = 'dominio';

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

    //Trae dominio segun parametros de $data
    function get_dominio($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }

    //Elimina un dominio
    function delete($id_dominio) {
        $this->db->where('id', $id_dominio);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }

    //Actualiza los datos del dominio
    function update($id_dominio, $datos) {
        $this->db->where('id', $id_dominio);
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }
}


