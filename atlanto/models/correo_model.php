<?php 

class Correo_model extends CI_Model {
	private $tabla = 'correo';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    //Guarda datos 
    function save($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
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

    //Traer permisos
    function get_todos() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }        
    }

    //Actualiza los datos
    function update($id_correo, $datos) {
        $this->db->where('id', $id_correo);
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }
}


