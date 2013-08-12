<?php 

class Impresora_model extends CI_Model {
    private $tabla = 'impresora';
    private $tabla_ubi = 'ubicacion';
    private $tabla_estado = 'estado_componente';
    private $tabla_mon_tipo = 'impresora_tipo';
    private $tabla_usu = 'usuario';
    private $tabla_dom = 'dominio';
    private $tabla_red = 'red';

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
            $where .= " AND ".$this->db->dbprefix($this->tabla).".id = ".$id;
        }
        $query = $this->db->query("SELECT 
                        ".$this->db->dbprefix($this->tabla).".id,
                        ".$this->db->dbprefix($this->tabla).".nombre,
                        ".$this->db->dbprefix($this->tabla).".id_ubicacion,
                        ".$this->db->dbprefix($this->tabla).".id_usuario,
                        ".$this->db->dbprefix($this->tabla).".id_estado,
                        ".$this->db->dbprefix($this->tabla).".id_tipo_impresora,
                        ".$this->db->dbprefix($this->tabla).".fabricante,
                        ".$this->db->dbprefix($this->tabla).".modelo,
                        ".$this->db->dbprefix($this->tabla).".n_serie,
                        ".$this->db->dbprefix($this->tabla).".n_activo,
                        ".$this->db->dbprefix($this->tabla).".id_dominio,
                        ".$this->db->dbprefix($this->tabla).".id_red,
                        ".$this->db->dbprefix($this->tabla).".ip,
                        ".$this->db->dbprefix($this->tabla).".comentarios,
                        ".$this->db->dbprefix($this->tabla).".fecha_modificacion,
                        ".$this->db->dbprefix($this->tabla_ubi).".nombre AS ubicacion,
                        CONCAT(".$this->db->dbprefix($this->tabla_usu).".nombre,' ', ".$this->db->dbprefix($this->tabla_usu).".apellido) AS usuario,
                        ".$this->db->dbprefix($this->tabla_estado).".nombre AS estado,
                        ".$this->db->dbprefix($this->tabla_mon_tipo).".nombre AS tipo,
                        ".$this->db->dbprefix($this->tabla_dom).".nombre AS dominio,
                        ".$this->db->dbprefix($this->tabla_red).".nombre AS red

                        FROM ".$this->db->dbprefix($this->tabla)." 

                        LEFT JOIN (".$this->db->dbprefix($this->tabla_ubi).")
                        ON(".$this->db->dbprefix($this->tabla).".id_ubicacion = ".$this->db->dbprefix($this->tabla_ubi).".id)

                        LEFT JOIN (".$this->db->dbprefix($this->tabla_usu).")
                        ON(".$this->db->dbprefix($this->tabla).".id_usuario = ".$this->db->dbprefix($this->tabla_usu).".id)

                        LEFT JOIN (".$this->db->dbprefix($this->tabla_estado).")
                        ON(".$this->db->dbprefix($this->tabla).".id_estado = ".$this->db->dbprefix($this->tabla_estado).".id)

                        LEFT JOIN (".$this->db->dbprefix($this->tabla_mon_tipo).")
                        ON(".$this->db->dbprefix($this->tabla).".id_tipo_impresora = ".$this->db->dbprefix($this->tabla_mon_tipo).".id)

                        LEFT JOIN (".$this->db->dbprefix($this->tabla_dom).")
                        ON(".$this->db->dbprefix($this->tabla).".id_dominio = ".$this->db->dbprefix($this->tabla_dom).".id)

                        LEFT JOIN (".$this->db->dbprefix($this->tabla_red).")
                        ON(".$this->db->dbprefix($this->tabla).".id_red = ".$this->db->dbprefix($this->tabla_red).".id)

                        WHERE ".$where."");
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

    function get_tipos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla_mon_tipo));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    //Traer so
    function get_so() {
        $query = $this->db->get($this->db->dbprefix($this->tabla_so));
        if ($query->num_rows() > 0){
            return $query->result();
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