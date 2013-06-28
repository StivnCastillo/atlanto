<?php 

class Usuario_model extends CI_Model {
    private $tabla = 'usuario';
	private $tabla_dep = 'departamento';
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
    function get_todos_usuarios() {
        $query = $this->db->query("SELECT ".$this->db->dbprefix($this->tabla).".id, 
                                    CONCAT(".$this->db->dbprefix($this->tabla).".nombre,' ', ".$this->db->dbprefix($this->tabla).".apellido) AS nombre_usuario, 
                                    ".$this->db->dbprefix($this->tabla).".email,
                                    ".$this->db->dbprefix($this->tabla).".telefono,
                                    ".$this->db->dbprefix($this->tabla).".activo,
                                    ".$this->db->dbprefix($this->tabla).".ultimo_ingreso,
                                    ".$this->db->dbprefix($this->tabla).".fecha_actualizado,
                                    ".$this->db->dbprefix($this->tabla_dep).".nombre AS departamento,
                                    atl_lugar.nombre AS lugar
                                    FROM ".$this->db->dbprefix($this->tabla)." 
                                    LEFT JOIN (".$this->db->dbprefix($this->tabla_dep).")
                                    ON (".$this->db->dbprefix($this->tabla).".id_departamento = ".$this->db->dbprefix($this->tabla_dep).".id)
                                    LEFT JOIN (atl_lugar)
                                    ON (atl_usuario.id_lugar = atl_lugar.id)
        ");
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    //Guarda datos de usuario
    function save($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
        
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