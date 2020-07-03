<?php

Class Repositorio_model extends CI_Model{
    
    
    function get_repos(){
       $query =  $this->db->get("repository");
       return $query->result_array();
    }
    
    public function get_user_repo() {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->or_where('use_rol_id', 1);
        $this->db->or_where('use_rol_id', 4);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insertar_repo() {
        $today = date("Y-m-d");
        $data = array(
            "rep_host" => $this->input->post('host'),
            "rep_port" => $this->input->post('puerto'),
            "rep_databasename" => $this->input->post('basededatos'),
            "rep_loggin" => $this->input->post('usuario'),
            "rep_password" => $this->input->post('contrasena'),
            "rep_affiliation" => $this->input->post('entidad'),
            "rep_registrationdate" => $today,
            "rep_url" => $this->input->post('url'),
            "rep_typerepository" => $this->input->post('tiporepositorio'),
            "rep_email" => $this->input->post('email'),
            "rep_name" => $this->input->post('nombrerepositorio'),
            "rep_metadata_inf" => $this->input->post('metadata'),
            "rep_frequency" => $this->input->post('periodicidad'),
            "rep_lastupdate" => $today,
            "rep_countoas" => 0,
            "use_username" => $this->input->post('usuariorepo')
        );
        $this->db->insert('repository', $data);
    }

    public function insertar_repo_roap() {
        $today = date("Y-m-d");
        $data = array(
            "rep_host" => $this->input->post('host'),
            "rep_port" => $this->input->post('puerto'),
            "rep_databasename" => $this->input->post('basededatos'),
            "rep_loggin" => $this->input->post('usuario'),
            "rep_password" => $this->input->post('contrasena'),
            "rep_affiliation" => $this->input->post('entidad'),
            "rep_registrationdate" => $today,
            "rep_url" => $this->input->post('url'),
            "rep_typerepository" => $this->input->post('tiporepositorio'),
            "rep_email" => $this->input->post('email'),
            "rep_name" => $this->input->post('nombrerepositorio'),
            "rep_metadata_inf" => $this->input->post('metadata'),
            "rep_lastupdate" => $today,
            "rep_countoas" => 0,
            "use_username" => $this->input->post('usuariorepo')
        );
        $this->db->insert('repository', $data);
    }

    public function get_repo_mod($rep_id) {
        //$id = $this->input->post('idrepository');
        $query = $this->db->get_where('repository', array('rep_id' => $rep_id));
        return $query->result_array();
    }

    public function modificar_repo() {
        $today = date("Y-m-d");
        $data = array(
            "rep_host" => $this->input->post('host'),
            "rep_port" => $this->input->post('puerto'),
            "rep_databasename" => $this->input->post('basededatos'),
            "rep_loggin" => $this->input->post('usuario'),
            "rep_password" => $this->input->post('contrasena'),
            "rep_affiliation" => $this->input->post('entidad'),
            "rep_registrationdate" => $this->input->post('registrationdate'),
            "rep_url" => $this->input->post('url'),
            "rep_typerepository" => $this->input->post('tiporepositorio'),
            "rep_email" => $this->input->post('email'),
            "rep_name" => $this->input->post('nombrerepositorio'),
            "rep_metadata_inf" => $this->input->post('metadata'),
            "rep_frequency" => $this->input->post('periodicidad'),
            "rep_lastupdate" => $today,
            "rep_countoas" => $this->input->post('countoas'),
            "use_username" => $this->input->post('usuariorepo')
        );
        $this->db->where('rep_id', intval($this->input->post('repository')));
        $this->db->update('repository', $data);
    }
     public function get_lo($rep_id, $lo_id) {

        $this->db->select('lo_id, lo_lastmodified');
        $this->db->from('lo');
        $this->db->where('rep_id', $rep_id);
        $this->db->where('lo_id', $lo_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insert_table($data, $tabla) { 
        $this->db->insert($tabla, $data);
    }
    public function update_table($data, $tabla, $campos, $valores) { 
        $size = sizeof($campos);
        for ($i = 0; $i < $size; $i++) {
            $this->db->where($campos[$i], $valores[$i]);
        }
        $this->db->update($tabla, $data);
    }

}
