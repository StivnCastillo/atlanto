<?php 

class Dispositivo_model extends CI_Model {
    private $tabla = 'dispositivo';
    private $tabla_est = 'estado_componente';
    private $tabla_usu = 'usuario';
    private $tabla_ubi = 'ubicacion';

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

    function get($id = FALSE)
    {
        $where = '1';
        if($id){
            $where .= ' AND '.$this->db->dbprefix($this->tabla).'.id = '.$id;
        }

        $query = $this->db->query("SELECT 
                ".$this->db->dbprefix($this->tabla).".id,
                ".$this->db->dbprefix($this->tabla).".nombre,
                ".$this->db->dbprefix($this->tabla).".id_ubicacion,
                ".$this->db->dbprefix($this->tabla).".id_usuario,
                ".$this->db->dbprefix($this->tabla).".id_estado,
                ".$this->db->dbprefix($this->tabla).".fabricante,
                ".$this->db->dbprefix($this->tabla).".modelo,
                ".$this->db->dbprefix($this->tabla).".n_serie,
                ".$this->db->dbprefix($this->tabla).".n_activo,
                ".$this->db->dbprefix($this->tabla).".prestable,
                ".$this->db->dbprefix($this->tabla).".fecha_modificacion,
                ".$this->db->dbprefix($this->tabla).".comentario,
                ".$this->db->dbprefix($this->tabla_ubi).".nombre AS ubicacion,
                CONCAT(".$this->db->dbprefix($this->tabla_usu).".nombre,' ',".$this->db->dbprefix($this->tabla_usu).".apellido) AS usuario,
                ".$this->db->dbprefix($this->tabla_est).".nombre AS estado

                FROM ".$this->db->dbprefix($this->tabla)."

                LEFT JOIN(".$this->db->dbprefix($this->tabla_ubi).")
                ON (".$this->db->dbprefix($this->tabla).".id_ubicacion = ".$this->db->dbprefix($this->tabla_ubi).".id)

                LEFT JOIN(".$this->db->dbprefix($this->tabla_usu).")
                ON (".$this->db->dbprefix($this->tabla).".id_usuario = ".$this->db->dbprefix($this->tabla_usu).".id)

                LEFT JOIN(".$this->db->dbprefix($this->tabla_est).")
                ON (".$this->db->dbprefix($this->tabla).".id_estado = ".$this->db->dbprefix($this->tabla_est).".id)

                WHERE ".$where."
        ");
        if ($query->num_rows() > 0){
            if($id){
                return $query->row();
            }
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


