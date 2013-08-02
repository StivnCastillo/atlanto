<?php 

class Monitor_model extends CI_Model {
    private $tabla = 'monitor';

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

    //Elimina un red
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }

    //Actualiza los datos del usuario
    function update($id, $datos) {
        $this->db->where('id', $id);
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }
}


