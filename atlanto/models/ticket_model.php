<?php 

class Ticket_model extends CI_Model {
    private $tabla = 'ticket';
    private $tabla_archivo = 'ticket_archivo';
    private $tabla_estado = 'ticket_estado';
    private $tabla_prioridad = 'ticket_prioridad';
    private $tabla_origen = 'ticket_origen';
    private $tabla_mensaje = 'ticket_mensaje';
	private $tabla_usuario = 'usuario';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    //Guarda datos de ticket
    function save($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    function save_archivo($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla_archivo), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    function save_mensaje($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla_mensaje), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    //Traer permisos
    function get_todos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }        
    }

    //Trae ticket segun parametros de $data
    function get_ticket($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }

    function get_mis_tickets($id, $id_ticket = FALSE){
        $where = "1 AND ";
        if($id_ticket){
            $where .= $this->db->dbprefix($this->tabla).".id AND";
        }
        $query = $this->db->query("
            SELECT 
            ".$this->db->dbprefix($this->tabla).".*,
            ".$this->db->dbprefix($this->tabla_origen).".nombre AS origen,
            ".$this->db->dbprefix($this->tabla_estado).".nombre AS estado,
            ".$this->db->dbprefix($this->tabla_prioridad).".nombre AS prioridad,
            CONCAT(".$this->db->dbprefix($this->tabla_usuario).".nombre, ' ', ".$this->db->dbprefix($this->tabla_usuario).".apellido) AS usuario

            FROM ".$this->db->dbprefix($this->tabla)." 

            LEFT JOIN(".$this->db->dbprefix($this->tabla_origen).", ".$this->db->dbprefix($this->tabla_estado).", ".$this->db->dbprefix($this->tabla_prioridad).", ".$this->db->dbprefix($this->tabla_usuario).")
            ON(
            ".$this->db->dbprefix($this->tabla).".id_origen = ".$this->db->dbprefix($this->tabla_origen).".id AND
            ".$this->db->dbprefix($this->tabla).".id_estado = ".$this->db->dbprefix($this->tabla_estado).".id AND
            ".$this->db->dbprefix($this->tabla).".id_prioridad = ".$this->db->dbprefix($this->tabla_prioridad).".id AND
            ".$this->db->dbprefix($this->tabla).".id_usuario = ".$this->db->dbprefix($this->tabla_usuario).".id
            )
            WHERE ".$where." ".$this->db->dbprefix($this->tabla).".id_usuario = ".$id." ORDER BY ".$this->db->dbprefix($this->tabla).".id ASC
        ");
        if ($query->num_rows() > 0){
            if($id_ticket){
                return $query->row();
            }
            return $query->result();
        }else{
            return FALSE;
        }
    }

    public function get_mensajes($id)
    {
        $query = $this->db->query("
            SELECT 
            ".$this->db->dbprefix($this->tabla_mensaje).".*,
            CONCAT(".$this->db->dbprefix($this->tabla_usuario).".nombre, ' ', ".$this->db->dbprefix($this->tabla_usuario).".apellido) AS usuario
            FROM 
            ".$this->db->dbprefix($this->tabla_mensaje)."
            LEFT JOIN (".$this->db->dbprefix($this->tabla_usuario).")
            ON(".$this->db->dbprefix($this->tabla_mensaje).".id_usuario = ".$this->db->dbprefix($this->tabla_usuario).".id)
            WHERE ".$this->db->dbprefix($this->tabla_mensaje).".id_ticket = ".$id." ORDER BY fecha ASC
            ");
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function get_archivos($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla_archivo));
        if ($query->num_rows() > 0){
            return $query->result();
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

    //Elimina un ticket
    function delete($id_ticket) {
        $this->db->where('id', $id_ticket);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }

    //Actualiza los datos del usuario
    function update($id_usuario, $datos) {
        $this->db->where('id', $id_usuario);
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }
}


