<?php 

class Usuario_model extends CI_Model {
	private $tabla = 'usuario';
	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    //Trae usuario segun parametros de $data
    function get_usuario($data) {
    	$this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
        	return $query->row();
        }else{
        	return FALSE;
        }        
    }

    //Traer todos los usuarios
    function get_todos_usuarios($raw = FALSE) {
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($raw)
            return $query;
        else
            return $query->result();
    }

    //Guarda datos de usuario
    function save($datos) {
        $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        return $this->db->insert_id();
    }

    //Actualiza los datos del usuario
    function update($id_usuario, $datos) {
        $this->db->where('id', $id_usuario);
        return  $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }

    //Elimina un usuario
    function delete($id_usuario) {
        $this->db->where('id', $id_usuario);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }

    function save_sesion_log($datos) {
        $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        return $this->db->insert_id();
    }
}