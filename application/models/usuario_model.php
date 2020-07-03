<?php

class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


    function get_all_users_data($username) {

        $query = $this->db->query("select users.use_username, users.use_nombre, users.use_rol_id
          from users
          inner join use_student on use_student.use_username=users.use_username 
        where users.use_username!='".$username."'");

        return $query->result_array();
    }

    function get_usr_data($username) {

        $this->db->select('use_username, use_nombre, use_rol_id');
        $this->db->from('users');
        $this->db->where('use_username', $username);
        $query = $this->db->get();

        return $query->result_array();
    }

    // Metodo que obtiene los registros de un estudiante a partir de un nombre de usuario dado,
    // a partir de la tabla estudiante, rol y nivel educativo


    function get_all_usr_data($username) {
        $query = $this->db->query("select users.use_username, users.use_nombre, users.use_email, users.use_fecha_registro,users.use_apellido, use_rol.use_rol_nombre, use_rol.use_rol_id, 
use_student.use_stu_datebirth, use_level.use_level, use_ls.use_ls_learningstyle, use_ls.use_ls_description
from users  
inner join use_student on use_student.use_username=users.use_username
inner join use_level on cast(use_level.use_id_level as text)=use_student.use_stu_level
left join use_ls on use_ls.use_ls_id=use_student.use_ls_id
inner join use_rol on use_rol.use_rol_id=users.use_rol_id
where users.use_username='".$username."'");


        return $query->result_array();
    }


    // Metodo que obtiene los registros del administrador a partir del nombre de usuario a partir de la tabla usuario

    function get_all_admin_data($username){
        $query = $this->db->query("select users.use_nombre, users.use_apellido, users.use_email, users.use_fecha_registro, use_rol.use_rol_nombre
from users inner join use_rol on use_rol.use_rol_id=users.use_rol_id
where users.use_username='".$username."'");

        return $query->result_array();
    }

    function save_score() {
        $query = $this->db->get_where('use_score', array('lo_id' => $this->input->post("lo_id"),
            'rep_id' => $this->input->post("rep_id"),"use_username" => $this->input->post("username")));
        if ($query->num_rows() == 0) {
            $data = array(
                "lo_id" => $this->input->post("lo_id"),
                "rep_id" => intval($this->input->post("rep_id")),
                "use_sco_score" => intval($this->input->post("score")),
                "use_sco_date" => date("j-m-y"),
                "use_username" => $this->input->post("username")
                );

            $this->db->insert('use_score', $data);
        } else {
            $data = array(
                "use_sco_score" => intval($this->input->post("score")),
                "use_sco_date" => date("j-m-y"),
                );

            $this->db->where('lo_id', $this->input->post("lo_id"));
            $this->db->where('use_username', $this->input->post("username"));
            $this->db->update('use_score', $data);
        }
    }

    function get_rol($username) {
    	$this->db->select('use_rol_id');
    	$this->db->from('users');
    	$this->db->where('use_username', $username);
    	$this->db->limit(1);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->result_array();
    	} else {
    		return false;
    	}
    }


    // Metodo que verifica si un nombre de usuario dado existe en la base de datos

    function verify_username($username) {
        //pendiente
        $this->db->select('use_username');
        $this->db->from('users');
        $this->db->where('use_username', $username);
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->num_rows();
    }

    // Metodo que guarda los registros a partir de la creación de una cuenta por parte del administrador.

    public function guardar_usuario() {

        $data = array(
         "use_username"        =>  $this->input->post("username"),
         "use_nombre"          =>  $this->input->post("nombre"),
         "use_apellido"        =>  $this->input->post("apellido"),
         "use_clave"           =>  md5($this->input->post("passwd2")),
         "use_email"           =>  $this->input->post("mail"),
         "use_fecha_registro"  =>  date("Y-m-d"),
         "use_rol_id"          =>  $this->input->post("rol"),
         );
        $this->db->insert('users', $data);
    }

    // Cuando un usuario (estudiante) se registra, la información se guarda en la tabla
    // de usuario: "users" y en la tabla del estudiante: "use_student"

    public function guardar_estudiante() {

        $today = date("Y-m-d");

/*
ESTAS CANTIDADES SON LAS QUE DEBERIAN LLEGAR DESDE EL CONTROLADOR
cantidad1
cantidad2
cantidad3
cantidad4
cantidad5
cantidad6*/

if ($this->input->post('result_test')!='') {
    $result_test = $this->input->post('result_test');
}else{
    $result_test = null;
}

if ($this->input->post('cantidad1')!='') {
    $cantidad1 = $this->input->post('cantidad1');
}else{
    $cantidad1 = null;
}

if ($this->input->post('cantidad2')!='') {
    $cantidad2 = $this->input->post('cantidad2');
}else{
    $cantidad2 = null;
}

if ($this->input->post('cantidad3')!='') {
    $cantidad3 = $this->input->post('cantidad3');
}else{
    $cantidad3 = null;
}

if ($this->input->post('cantidad4')!='') {
    $cantidad4 = $this->input->post('cantidad4');
}else{
    $cantidad4 = null;
}

if ($this->input->post('cantidad5')!='') {
    $cantidad5 = $this->input->post('cantidad5');
}else{
    $cantidad5 = null;
}

if ($this->input->post('cantidad6')!='') {
    $cantidad6 = $this->input->post('cantidad6');
}else{
    $cantidad6 = null;
}


        $data = array(
            'use_username' => $this->input->post('username'),
            'use_stu_datebirth' => $this->input->post('fecha_nac'),
            'use_ls_id' => $result_test,
            'use_stu_level' => $this->input->post('nevel_ed'),
            'use_ls_cant_V' => $cantidad1,
            'use_ls_cant_A' => $cantidad2,
            'use_ls_cant_R' => $cantidad3,
            'use_ls_cant_K' => $cantidad4,
            'use_ls_cant_G' => $cantidad5,
            'use_ls_cant_S' => $cantidad6,
        );
        $data2 = array(
            'use_username' => $this->input->post('username'),
            'use_nombre' => $this->input->post('nombre'),
            'use_apellido'=>  $this->input->post('apellido'),
            'use_clave' => md5($this->input->post('passwd')),
            'use_email' => ($this->input->post('mail')),
            'use_fecha_registro' => $today,
            'use_rol_id'=> $this->input->post('tipoU'),
        );

        $this->db->insert('users', $data2);
        $this->db->insert('use_student', $data);
    }

    //Guarda cada una de las preferencias del estudiante en la tabla "use_pre_stu"

    public function insert_pref($pref, $id) {

        $data = array(
            'use_pre_id' => $pref,
            'use_username' => $id
        );
        $this->db->insert('use_pre_stu', $data);
    }

    public function insert_format($format, $id) {

        $data = array(
            'use_format' => $format,
            'use_username' => $id
        );
        $this->db->insert('use_pref_format', $data);
    }

    public function insert_language($language, $id) {

        $data = array(
            'use_language' => $language,
            'use_username' => $id
        );
        $this->db->insert('use_pref_language', $data);
    }

    //Si el usuario tiene una NEED se actualiza

    public function has_need($username){
        $data = array("use_username" => $username);
        $this->db->insert("use_need", $data);
    }

    public function update_has_need($username,$need_vision, $need_visiondescri, $need_audicion, $need_audiciondescri,
                                    $need_motriz, $need_motrizdescri, $need_coginitiva, $need_cognitivatexto,
                                    $need_cognitivainstru, $need_cognitivaconcentra)
    {
        $data = array(
            "use_need_vision" => $need_vision,
            "use_need_visiondescri"=> $need_visiondescri,
            "use_need_audicion" => $need_audicion,
            "use_need_audiciondescri" => $need_audiciondescri,
            "use_need_motriz" => $need_motriz,
            "use_need_motrizdescri" => $need_motrizdescri,
            "use_need_cognitiva" => $need_coginitiva,
            "use_need_cognitivatexto" => $need_cognitivatexto,
            "use_need_cognitivainstru" => $need_cognitivainstru,
            "use_need_cognitivaconcentr" => $need_cognitivaconcentra);

        $this->db->where("use_username", $username);
        $this->db->update('use_need', $data);

    }

    // Se obtienen los registros de las preferencias que hay en la tabla "use_preference"

    public function get_preferencias() {

        $query = $this->db->get('use_preference');

        return $query->result();
    }


    // Se obtienen los registros de las preferencias que hay en la tabla "use_level"

    public function get_nivel_educativo() {


        $query = $this->db->get('use_level');

        return $query->result();
    }


    //Metodo que selecciona las preferencias de un estudiante dado

    public function get_preferencia_est($user) {
        $this->db->select('*');
        $this->db->from('use_pre_stu');
        $this->db->where('use_username', $user);
        $this->db->join('use_preference', 'use_pre_stu.use_pre_id = use_preference.use_pre_id');
        $query = $this->db->get();
        return $query->result();
    }


    public function update_user($username){
        $data1 = array(
            "use_nombre"          =>  $this->input->post("nombre"),
            "use_apellido"        =>  $this->input->post("apellido"),
            "use_email"           =>  $this->input->post("mail"),
            "use_rol_id"          =>  $this->input->post("tipoU"),

        );
        $data2 = array(
            "use_stu_level"       =>  $this->input->post("nevel_ed"),
            "use_stu_datebirth"       =>  $this->input->post("fecha_nac")
        );

        $this->db->where('use_username', $username);
        $this->db->update('users', $data1);
        $this->db->update('use_student', $data2);
    }

    //Se verifica si el correo electrónico ingresado existe en la base de datos

    function verify_email($mail){

        $this->db->select('use_email');
        $this->db->from('users');
        $this->db->where('use_email', $mail);
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->num_rows();
    }


    public function get_rol_data() {

        // Se obtienen los registros de los roles que hay en la tabla "use_rol"
        $query = $this->db->get('use_rol');

        return $query->result();
    }

    function verificar_passwd($passwd, $username){
        $this->db->select('use_clave');
        $this->db->from('users');
        $this->db->where('use_username', $username);
        $this->db->where('use_clave', $passwd);
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->num_rows();
    }

    function actualizar_passwd($passwd, $username){

        $data = array(
            "use_clave"          =>  $passwd
        );
        $this->db->where('use_username', $username);
        $this->db->update('users', $data);

    }

    function get_score(){
        $query = $this->db->get_where('use_score', array('lo_id' => $this->input->post("lo_id"),
            'rep_id' => $this->input->post("rep_id"), 'use_username' => $this->input->post("username") ));

        return $query->result_array();
    }

    /*
    function update_test($estilo,$cant_V,$cant_A,$cant_R,$cant_K,$cant_G,$cant_S, $id) {

        $data = array(
            'use_ls_id' => $estilo
            'use_ls_cant_V' => $cant_V
            'use_ls_cant_R' => $cant_R
            'use_ls_cant_A' => $cant_A
            'use_ls_cant_K' => $cant_K
            'use_ls_cant_G' => $cant_G
            'use_ls_cant_S' => $cant_S
        );

        $this->db->where('use_username', $id);
        $this->db->update('use_student', $data);
    }



*/




}
