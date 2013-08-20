<?php 

class Componente_model extends CI_Model {
    private $tabla = 'componente';
    private $tabla_disco = 'componente_discoduro';
    private $tabla_pro = 'componente_procesador';
    private $tabla_int = 'componente_interfaz';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    //////////////////Disco duro
    function get_discosduro($id = FALSE){
        $where = '1';
        if ($id) {
            $where = " ".$this->db->dbprefix($this->tabla_disco).".id = ".$id;
        }
        $query = $this->db->query("SELECT 
                ".$this->db->dbprefix($this->tabla_disco).".id,
                ".$this->db->dbprefix($this->tabla_disco).".nombre,
                ".$this->db->dbprefix($this->tabla_disco).".fabricante,
                ".$this->db->dbprefix($this->tabla_disco).".capacidad,
                ".$this->db->dbprefix($this->tabla_disco).".rpm,
                ".$this->db->dbprefix($this->tabla_disco).".cache,
                ".$this->db->dbprefix($this->tabla_disco).".id_interfaz,
                ".$this->db->dbprefix($this->tabla_disco).".fecha_modificacion,
                ".$this->db->dbprefix($this->tabla_disco).".comentarios,
                ".$this->db->dbprefix($this->tabla_int).".nombre AS interfaz

                FROM ".$this->db->dbprefix($this->tabla_disco)." 

                LEFT JOIN(".$this->db->dbprefix($this->tabla_int).")
                ON(".$this->db->dbprefix($this->tabla_disco).".id_interfaz = ".$this->db->dbprefix($this->tabla_int).".id)

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
    
    function save_discoduro($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla_disco), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    function update_discoduro($id, $datos) {
        $this->db->where('id', $id);
        return $this->db->update($this->db->dbprefix($this->tabla_disco), $datos);
    }

    function delete_discoduro($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->db->dbprefix($this->tabla_disco));
    }



    ////////////// Procesador
    function get_procesador($id = FALSE){
        $where = '1';
        if ($id) {
            $where = " ".$this->db->dbprefix($this->tabla_pro).".id = ".$id;
        }
        $query = $this->db->query("SELECT 
                ".$this->db->dbprefix($this->tabla_pro).".id,
                ".$this->db->dbprefix($this->tabla_pro).".nombre,
                ".$this->db->dbprefix($this->tabla_pro).".fabricante,
                ".$this->db->dbprefix($this->tabla_pro).".frecuencia,
                ".$this->db->dbprefix($this->tabla_pro).".fecha_modificacion,
                ".$this->db->dbprefix($this->tabla_pro).".comentarios

                FROM ".$this->db->dbprefix($this->tabla_pro)." 

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

    function save_procesador($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla_pro), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    function update_procesador($id, $datos) {
        $this->db->where('id', $id);
        return $this->db->update($this->db->dbprefix($this->tabla_pro), $datos);
    }

    function delete_procesador($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->db->dbprefix($this->tabla_pro));
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


