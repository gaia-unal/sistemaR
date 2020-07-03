<?php


class Admin_model extends CI_Model {

    function get_total_lo(){
        $query = $this->db->count_all('lo');
        return $query;
    }

    function get_total_user(){
        $query = $this->db->count_all('users');
        return $query;
    }

    function get_total_rep(){
        $query = $this->db->count_all('repository');
        return $query;
    }

    function get_total_lo_score(){
        $query = $this->db->count_all('use_score');
        return $query;
    }

    /**
     * Esta función muestra muestra los datos de los usuarios registrados en el módulo de gestión de usuarios
     * en la opción listar usuarios.
     */

    function get_users(){
        $this->db->select('users.use_username, users.use_nombre, users.use_apellido, users.use_email,
        users.use_fecha_registro, use_rol.use_rol_nombre');
        $this->db->from('users');
        $this->db->join('use_rol', 'users.use_rol_id=use_rol.use_rol_id');
        $this->db->where('users.use_rol_id !=', 1);
        $query = $this->db->get("");
        return $query->result_array();
    }

    function get_lo_score(){
        $query = $this->db->get("use_score");
        return $query->result_array();
    }

    function del_usr($username){
        $this->db->delete('users', array('use_username' => $username));
    }
}
