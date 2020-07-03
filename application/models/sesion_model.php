<?php

Class Sesion_model extends CI_Model {

    function login($username, $password) {
        $this->db->select('use_username, use_clave');
        $this->db->from('users');
        $this->db->where('use_username', $username);
        $this->db->where('use_clave', md5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function tipo_sesion($username) {
        $this->db->select("rol");
        $this->db->from("users");
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->result_array();
    }
        


}

?>