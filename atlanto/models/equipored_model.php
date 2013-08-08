<?php 

class Equipored_model extends CI_Model {
	private $tabla = 'equipo_red';
	private $tabla_usu = 'usuario';
	private $tabla_ubi = 'ubicacion';
	private $tabla_red = 'red';
	private $tabla_dom = 'dominio';
	private $tabla_est = 'estado_componente';

	function __construct() {
        parent::__construct();
    }
    
    function save($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
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

    function get_todos_equipos($id = FALSE)
    {
    	$where = '1';
    	if($id){
    		$where .= " AND ".$this->db->dbprefix($this->tabla).".id = ".$id;
    	}

    	$query = $this->db->query("SELECT
							".$this->db->dbprefix($this->tabla).".id,
							".$this->db->dbprefix($this->tabla).".nombre,
							".$this->db->dbprefix($this->tabla).".id_usuario,
							".$this->db->dbprefix($this->tabla).".id_ubicacion,
							".$this->db->dbprefix($this->tabla).".id_estado,
							".$this->db->dbprefix($this->tabla).".fabricante,
							".$this->db->dbprefix($this->tabla).".modelo,
							".$this->db->dbprefix($this->tabla).".n_serie,
							".$this->db->dbprefix($this->tabla).".n_activo,
							".$this->db->dbprefix($this->tabla).".id_dominio,
							".$this->db->dbprefix($this->tabla).".id_red,
							".$this->db->dbprefix($this->tabla).".ip,
							".$this->db->dbprefix($this->tabla).".mac,
							".$this->db->dbprefix($this->tabla).".comentarios,
							CONCAT(".$this->db->dbprefix($this->tabla_usu).".nombre, ' ', ".$this->db->dbprefix($this->tabla_usu).".apellido) AS usuario,
							".$this->db->dbprefix($this->tabla_ubi).".nombre AS ubicacion,
							".$this->db->dbprefix($this->tabla_est).".nombre AS estado,
							".$this->db->dbprefix($this->tabla_dom).".nombre AS dominio,
							".$this->db->dbprefix($this->tabla_red).".nombre AS red

							FROM ".$this->db->dbprefix($this->tabla)." 

							LEFT JOIN(".$this->db->dbprefix($this->tabla_usu).")
							ON (".$this->db->dbprefix($this->tabla).".id_usuario = ".$this->db->dbprefix($this->tabla_usu).".id)

							LEFT JOIN(".$this->db->dbprefix($this->tabla_ubi).")
							ON (".$this->db->dbprefix($this->tabla).".id_ubicacion = ".$this->db->dbprefix($this->tabla_ubi).".id)

							LEFT JOIN(".$this->db->dbprefix($this->tabla_est).")
							ON (".$this->db->dbprefix($this->tabla).".id_estado = ".$this->db->dbprefix($this->tabla_est).".id)

							LEFT JOIN(".$this->db->dbprefix($this->tabla_dom).")
							ON (".$this->db->dbprefix($this->tabla).".id_dominio = ".$this->db->dbprefix($this->tabla_dom).".id)

							LEFT JOIN(".$this->db->dbprefix($this->tabla_red).")
							ON (".$this->db->dbprefix($this->tabla).".id_red = ".$this->db->dbprefix($this->tabla_red).".id)

							WHERE ".$where."
		");
        if ($query->num_rows() > 0){
        	if($id){
        		return $query->row();
        	}else{
        		return $query->result();
        	}            
        }else{
            return FALSE;
        }
    }

    function get_dominio($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }

    function delete($id_dominio) {
        $this->db->where('id', $id_dominio);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }

    function update($id_dominio, $datos) {
        $this->db->where('id', $id_dominio);
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }
}


