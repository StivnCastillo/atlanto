<?php 

class Tarea_model extends CI_Model {
    private $tabla = 'tarea';
    private $tabla_usu = 'usuario';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    //Traer todos las tareas
    function get_todos($id_usuario = FALSE) {
        if($id_usuario){
            $where = " ".$this->db->dbprefix($this->tabla).".id_usuario_asignado = ".$id_usuario;
        }else{
            $where = "1";
        }
        $query = $this->db->query("SELECT ".$this->db->dbprefix($this->tabla).".id,
                                ".$this->db->dbprefix($this->tabla).".titulo,
                                ".$this->db->dbprefix($this->tabla).".fecha_inicio,
                                ".$this->db->dbprefix($this->tabla).".fecha_fin,
                                ".$this->db->dbprefix($this->tabla).".estado,
                                ".$this->db->dbprefix($this->tabla_usu).".id AS id_usuario,
                                ".$this->db->dbprefix($this->tabla_usu).".nombre,
                                ".$this->db->dbprefix($this->tabla_usu).".apellido

                                FROM ".$this->db->dbprefix($this->tabla)."
                                LEFT JOIN(".$this->db->dbprefix($this->tabla_usu).")
                                ON
                                (".$this->db->dbprefix($this->tabla_usu).".id = ".$this->db->dbprefix($this->tabla).".id_usuario_asignado)
                                WHERE ".$where." ORDER BY ".$this->db->dbprefix($this->tabla).".id DESC"
        );
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    //Traer tarea segun parametros
    function get_tarea($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }        
    }

    //Guarda datos de tarea
    function save($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    //Actualiza los datos del tarea
    function update($id_tarea, $datos) {
        $this->db->where('id', $id_tarea);
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }

    //Elimina un tarea
    function delete($id_usuario) {
        $this->db->where('id', $id_usuario);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }
}