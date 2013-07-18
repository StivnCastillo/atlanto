<?php 

class Usuario_model extends CI_Model {
    private $tabla = 'usuario';
    private $tabla_dep = 'departamento';
    private $tabla_lug = 'ubicacion';
	private $tabla_car = 'cargo';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
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
                                    ".$this->db->dbprefix($this->tabla_lug).".nombre AS lugar
                                    FROM ".$this->db->dbprefix($this->tabla)." 
                                    LEFT JOIN (".$this->db->dbprefix($this->tabla_dep).")
                                    ON (".$this->db->dbprefix($this->tabla).".id_departamento = ".$this->db->dbprefix($this->tabla_dep).".id)
                                    LEFT JOIN (".$this->db->dbprefix($this->tabla_lug).")
                                    ON (".$this->db->dbprefix($this->tabla).".id_lugar = ".$this->db->dbprefix($this->tabla_lug).".id)
        ");
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function get_administradores() {
        $this->db->where(array('id_rol' => 1));
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }        
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

    //Traer usuario segun parametros
    function get_usuarios($id_usuario = FALSE) {
        if ($id_usuario) {
            $where = "WHERE ".$this->db->dbprefix($this->tabla).".id = ".$id_usuario."";
        }else{
            $where = "";
        }
        $query = $this->db->query("SELECT ".$this->db->dbprefix($this->tabla).".id,
                                    ".$this->db->dbprefix($this->tabla).".nombre AS nom_usuario,
                                    ".$this->db->dbprefix($this->tabla).".apellido,
                                    ".$this->db->dbprefix($this->tabla).".usuario,
                                    ".$this->db->dbprefix($this->tabla).".email,
                                    ".$this->db->dbprefix($this->tabla).".telefono,
                                    ".$this->db->dbprefix($this->tabla).".activo,
                                    ".$this->db->dbprefix($this->tabla).".nota_interna,
                                    ".$this->db->dbprefix($this->tabla).".id_rol,
                                    ".$this->db->dbprefix($this->tabla_dep).".nombre AS departamento,
                                    ".$this->db->dbprefix($this->tabla_dep).".id AS id_departamento,
                                    ".$this->db->dbprefix($this->tabla_car).".nombre AS cargo,
                                    ".$this->db->dbprefix($this->tabla_car).".id AS id_cargo,
                                    ".$this->db->dbprefix($this->tabla_lug).".nombre AS lugar,
                                    ".$this->db->dbprefix($this->tabla_lug).".id AS id_lugar
                                    FROM ".$this->db->dbprefix($this->tabla)." 
                                    LEFT JOIN (".$this->db->dbprefix($this->tabla_dep).")
                                    ON (".$this->db->dbprefix($this->tabla).".id_departamento = ".$this->db->dbprefix($this->tabla_dep).".id)
                                    LEFT JOIN (".$this->db->dbprefix($this->tabla_lug).")
                                    ON (".$this->db->dbprefix($this->tabla).".id_lugar = ".$this->db->dbprefix($this->tabla_lug).".id)
                                    LEFT JOIN (".$this->db->dbprefix($this->tabla_car).")
                                    ON (".$this->db->dbprefix($this->tabla).".id_cargo = ".$this->db->dbprefix($this->tabla_car).".id)
                                    ".$where."
        ");
        if ($query->num_rows() > 0){
            return $query->row();
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
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
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

    //Traer todas los usuarios
    function get_todos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function buscar($valor){
        $query = $this->db->query("SELECT id, CONCAT(nombre, ' ', apellido) AS nombre FROM ".$this->db->dbprefix($this->tabla)." WHERE nombre LIKE '%".$valor."%' OR apellido LIKE '%".$valor."%'");
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
}