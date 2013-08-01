<?php 

class So_model extends CI_Model {
    private $tabla = 'sistema_operativo';
	private $tabla_tipos = 'sistema_tipo';

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

    //Traer datos
    function get_todos() {
        $query = $this->db->query("
            SELECT 
            ".$this->db->dbprefix($this->tabla).".id,
            ".$this->db->dbprefix($this->tabla).".nombre,
            ".$this->db->dbprefix($this->tabla).".id_tipo_sistema,
            ".$this->db->dbprefix($this->tabla).".version,
            ".$this->db->dbprefix($this->tabla).".descripcion,
            ".$this->db->dbprefix($this->tabla_tipos).".nombre AS tipo_so

            FROM ".$this->db->dbprefix($this->tabla)."

            LEFT JOIN (".$this->db->dbprefix($this->tabla_tipos).")
            ON(".$this->db->dbprefix($this->tabla).".id_tipo_sistema = ".$this->db->dbprefix($this->tabla_tipos).".id)
            ");
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }      
    }

    //Traer datos
    function get_so($id) {
        $query = $this->db->query("
            SELECT 
            ".$this->db->dbprefix($this->tabla).".id,
            ".$this->db->dbprefix($this->tabla).".nombre,
            ".$this->db->dbprefix($this->tabla).".id_tipo_sistema,
            ".$this->db->dbprefix($this->tabla).".version,
            ".$this->db->dbprefix($this->tabla).".descripcion,
            ".$this->db->dbprefix($this->tabla_tipos).".nombre AS tipo_so,
            ".$this->db->dbprefix($this->tabla_tipos).".id AS id_tipo_so

            FROM ".$this->db->dbprefix($this->tabla)."

            LEFT JOIN (".$this->db->dbprefix($this->tabla_tipos).")
            ON(".$this->db->dbprefix($this->tabla).".id_tipo_sistema = ".$this->db->dbprefix($this->tabla_tipos).".id)

            WHERE ".$this->db->dbprefix($this->tabla).".id = ".$id."
            ");
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }      
    }

    //Traer datos
    function get_tipos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla_tipos));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
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


