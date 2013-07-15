<?php 

class Mail_model extends CI_Model {

    private $tabla = 'mail';
	private $tabla_pre = 'mail_predefinido';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    //Trae los mensajes predefinidos segun el tipo
    function get_predefinido($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla_pre));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }    
}