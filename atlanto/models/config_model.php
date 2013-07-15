<?php 

class Config_model extends CI_Model {

	private $tabla = 'config';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    //Trae configuraciones segun parametros de $data
    function get($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
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
}