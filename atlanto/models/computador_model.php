<?php 

class Computador_model extends CI_Model {
    private $tabla = 'computador';
    private $tabla_ubi = 'ubicacion';
    private $tabla_com_estado = 'computador_estado';
    private $tabla_com_tipo = 'computador_tipo';
    private $tabla_usu = 'usuario';
    private $tabla_dom = 'dominio';
    private $tabla_red = 'red';
    private $tabla_so = 'sistema_operativo';
	private $tabla_so_tipo = 'sistema_tipo';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    //Guarda datos de computador
    function save($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    //Traer computador
    function get($id = FALSE) {
        $where = '1';
        if ($id) {
            $where = " ".$this->db->dbprefix($this->tabla).".id = ".$id;
        }
        $query = $this->db->query("SELECT 
                ".$this->db->dbprefix($this->tabla).".id,
                ".$this->db->dbprefix($this->tabla).".nombre AS nombre_computador,
                ".$this->db->dbprefix($this->tabla).".fabritante,
                ".$this->db->dbprefix($this->tabla).".modelo,
                ".$this->db->dbprefix($this->tabla).".fecha_modificacion,
                ".$this->db->dbprefix($this->tabla).".comentarios,
                ".$this->db->dbprefix($this->tabla).".n_serie,
                ".$this->db->dbprefix($this->tabla).".n_activo,
                ".$this->db->dbprefix($this->tabla_ubi).".nombre AS ubicacion,
                ".$this->db->dbprefix($this->tabla_com_estado).".nombre AS estado,
                ".$this->db->dbprefix($this->tabla_com_tipo).".nombre AS com_tipo,
                ".$this->db->dbprefix($this->tabla_usu).".id AS idusuario,
                CONCAT(".$this->db->dbprefix($this->tabla_usu).".nombre, ' ', ".$this->db->dbprefix($this->tabla_usu).".apellido) AS nombre_usuario,
                ".$this->db->dbprefix($this->tabla_dom).".nombre AS dominio,
                ".$this->db->dbprefix($this->tabla_red).".nombre AS red,
                ".$this->db->dbprefix($this->tabla_so).".nombre AS sistema_operativo,
                ".$this->db->dbprefix($this->tabla_so).".version,
                ".$this->db->dbprefix($this->tabla_so_tipo).".nombre AS tipo_so

                FROM ".$this->db->dbprefix($this->tabla)." 

                LEFT JOIN (".$this->db->dbprefix($this->tabla_so).")
                ON (".$this->db->dbprefix($this->tabla_so).".id = ".$this->db->dbprefix($this->tabla).".id_SO)

                LEFT JOIN (".$this->db->dbprefix($this->tabla_so_tipo).")
                ON (".$this->db->dbprefix($this->tabla_so_tipo).".id = ".$this->db->dbprefix($this->tabla_so).".id_tipo_sistema)

                LEFT JOIN(".$this->db->dbprefix($this->tabla_ubi).")
                ON(".$this->db->dbprefix($this->tabla_ubi).".id = ".$this->db->dbprefix($this->tabla).".id_ubicacion)

                LEFT JOIN (".$this->db->dbprefix($this->tabla_dom).")
                ON (".$this->db->dbprefix($this->tabla_dom).".id = ".$this->db->dbprefix($this->tabla).".id_dominio)

                LEFT JOIN (".$this->db->dbprefix($this->tabla_usu).")
                ON (".$this->db->dbprefix($this->tabla_usu).".id = ".$this->db->dbprefix($this->tabla).".id_usuario)

                LEFT JOIN (".$this->db->dbprefix($this->tabla_com_tipo).")
                ON (".$this->db->dbprefix($this->tabla_com_tipo).".id = ".$this->db->dbprefix($this->tabla).".id_tipo)

                LEFT JOIN (".$this->db->dbprefix($this->tabla_com_estado).")
                ON(".$this->db->dbprefix($this->tabla_com_estado).".id = ".$this->db->dbprefix($this->tabla).".id_estado)

                LEFT JOIN( ".$this->db->dbprefix($this->tabla_red).")
                ON(".$this->db->dbprefix($this->tabla_red).".id = ".$this->db->dbprefix($this->tabla).".id_red)
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

    //Trae computador segun parametros de $data
    function get_datos($data) {
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

    //Elimina un computador
    function delete($id_computador) {
        $this->db->where('id', $id_computador);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }

    //Actualiza los datos del computador
    function update($id_computador, $datos) {
        $this->db->where('id', $id_computador);
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }
}


