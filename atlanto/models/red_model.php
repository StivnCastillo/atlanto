<?php 

class Red_model extends CI_Model {
	private $tabla = 'red';

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

    //Traer redes
    function get_todos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }        
    }

    //Trae red segun parametros de $data
    function get_red($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }

    //Elimina un red
    function delete($id_red) {
        $this->db->where('id', $id_red);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }

    //Actualiza los datos del usuario
    function update($id_red, $datos) {
        $this->db->where('id', $id_red);
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }
}


