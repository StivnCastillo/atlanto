<?php 

class Telefono_model extends CI_Model {
	private $tabla = 'telefono';
    private $tabla_ubi = 'ubicacion';
    private $tabla_estado = 'estado_componente';
    private $tabla_tel_tipo = 'telefono_tipo';
    private $tabla_usu = 'usuario';
    private $tabla_dom = 'dominio';

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

    //Traer permisos
    function get($id = FALSE) {
        $where = '1';
        if($id){
            $where .= ' AND '.$this->db->dbprefix($this->tabla).'.id = '.$id;
        }
        $query = $this->db->query("
                    SELECT 
                    ".$this->db->dbprefix($this->tabla).".id,
                    ".$this->db->dbprefix($this->tabla).".nombre,
                    ".$this->db->dbprefix($this->tabla).".id_ubicacion,
                    ".$this->db->dbprefix($this->tabla).".id_estado,
                    ".$this->db->dbprefix($this->tabla).".id_usuario,
                    ".$this->db->dbprefix($this->tabla).".id_telefono_tipo,
                    ".$this->db->dbprefix($this->tabla).".fabricante,
                    ".$this->db->dbprefix($this->tabla).".modelo,
                    ".$this->db->dbprefix($this->tabla).".n_serie,
                    ".$this->db->dbprefix($this->tabla).".n_activo,
                    ".$this->db->dbprefix($this->tabla).".firmware,
                    ".$this->db->dbprefix($this->tabla).".ip,
                    ".$this->db->dbprefix($this->tabla).".comentarios,
                    ".$this->db->dbprefix($this->tabla).".fecha_modificacion,
                    ".$this->db->dbprefix($this->tabla_ubi).".nombre AS ubicacion,
                    CONCAT(".$this->db->dbprefix($this->tabla_usu).".nombre, ' ', ".$this->db->dbprefix($this->tabla_usu).".apellido) AS usuario,
                    ".$this->db->dbprefix($this->tabla_tel_tipo).".nombre AS tipo,
                    ".$this->db->dbprefix($this->tabla_estado).".nombre AS estado

                    FROM ".$this->db->dbprefix($this->tabla)." 

                    LEFT JOIN (".$this->db->dbprefix($this->tabla_ubi).")
                    ON (".$this->db->dbprefix($this->tabla).".id_ubicacion = ".$this->db->dbprefix($this->tabla_ubi).".id)

                    LEFT JOIN (".$this->db->dbprefix($this->tabla_usu).")
                    ON (".$this->db->dbprefix($this->tabla).".id_usuario = ".$this->db->dbprefix($this->tabla_usu).".id)

                    LEFT JOIN (".$this->db->dbprefix($this->tabla_tel_tipo).")
                    ON (".$this->db->dbprefix($this->tabla).".id_telefono_tipo = ".$this->db->dbprefix($this->tabla_tel_tipo).".id)

                    LEFT JOIN (".$this->db->dbprefix($this->tabla_estado).")
                    ON (".$this->db->dbprefix($this->tabla).".id_estado = ".$this->db->dbprefix($this->tabla_estado).".id)

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

    //Trae cargo segun parametros de $data
    function get_cargo($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }

    function buscar($valor){
    	$query = $this->db->query("SELECT id, nombre FROM ".$this->db->dbprefix($this->tabla)." WHERE nombre LIKE '%".$valor."%'");
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    //Elimina un cargo
    function delete($id_cargo) {
        $this->db->where('id', $id_cargo);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }

    //Actualiza los datos del usuario
    function update($id_usuario, $datos) {
        $this->db->where('id', $id_usuario);
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }
}


