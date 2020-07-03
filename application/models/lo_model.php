<?php

Class Lo_model extends CI_Model {

    function get_oas_b($orParams, $andParams) {

        $andQuery = $this->db->query(
            "SELECT lo_id, rep_id, lo_title, lo_language, lo_description,
                    lo_keyword, lo_location,
                    ts_rank_cd(campo_busqueda_index_col, query) AS rank
                    FROM lo, to_tsquery" . $andParams . "query
                        WHERE query @@ campo_busqueda_index_col
                        and lo_location is not null ORDER BY rank DESC;"
        );

        $orQuery = $this->db->query(
            "SELECT lo_id, rep_id, lo_title, lo_language, lo_description,
                    lo_keyword, lo_location,
                     ts_rank_cd(campo_busqueda_index_col, query) AS rank
                    FROM lo, to_tsquery" . $orParams . "query
                        WHERE query @@ campo_busqueda_index_col and lo_location is not null
                        ORDER BY rank DESC;"
        );
        $result = array();
        $resultAnd = array();
        $resultOr = array();
        foreach ($andQuery->result_array() as $and) {
            array_push($resultAnd, $and);
        }

        foreach ($orQuery->result_array() as $or) {
            array_push($resultOr, $or);
        }
        //echo $orParams;
        array_push($result, $resultAnd);
        array_push($result, $resultOr);
        return $result;
    }

    public function get_preferences_format($username) {

        $query = $this->db->query("select use_format from use_pref_format where use_username='".$username."'");

        return $query->result_array();
    }

    public function get_preferences_structure() {

        $query = $this->db->query("select * from lo where lo_structure='atomic'");

        return $query->result_array();
    }

    public function get_oa_by_format($format){

        $query = $this->db->query("select * from lo where lo_format='".$format."'");

        return $query->result_array();

    }

    public function get_oa_by_language($language){

        $query = $this->db->query("select * from lo where lo_language='".$language."'");

        return $query->result_array();

    }

    //Metodo que obtien las preferencias de lenguage de OAS

    function get_preferences_language($username){

        $query = $this->db->query("select use_language  
      from use_pref_language  
      where use_username='".$username."'");

        return $query->result_array();

    }

    
    public function base64_url_decode($input) {
        return base64_decode(strtr($input, '.', '/'));
    }

    public function guardar_log($lo_id,$rep_id,$url,$title,$argument,$argument_type,$argument_code,$argument_number,$calificacion,$evaluacion) {

        $today = date("Y-m-d");
        $session_data = $this->session->userdata('logged_in');


        $data = array(
            "use_username"          =>  $session_data['username'],
            "lo_id"                 =>  $this->base64_url_decode($lo_id),
            "rep_id"                =>  $this->base64_url_decode($rep_id),
            "lo_title"              =>  $this->base64_url_decode($title),
            "lo_url"                =>  $this->base64_url_decode($url),
            "argument_type"         =>  $this->base64_url_decode($argument_type),
            "argument_code"         =>  $this->base64_url_decode($argument_code),
            "argument_text"         =>  $this->base64_url_decode($argument),
            "argument_score"        =>  $this->input->post($calificacion),
            "argument_acceptance"   =>  $this->input->post($evaluacion),
            "argument_number"       =>  $argument_number,
            "fecha"                 =>  $today,

        );
        $this->db->insert('log', $data);
    }

    function guardar_calificacion_lo($lo_id,$rep_id,$argument_code,$calificacion,$comentarios) {
             
        $today = date("Y-m-d");
        $hour= date("Y-m-d H:i:s");
        $session_data = $this->session->userdata('logged_in');

        $data = array(
            'lo_id'             => $this->base64_url_decode($lo_id),
            'rep_id'            => $this->base64_url_decode($rep_id),
            'use_sco_score'     => $this->input->post($calificacion),
            'use_sco_date'      => $today,
            'use_username'      => $session_data['username'],
            'use_sco_time'      => $hour,
            'use_sco_comment'   => $this->input->post($comentarios),
            "argument_code"     => $this->base64_url_decode($argument_code),

        );

        $this->db->insert('use_score', $data);
    }

    function update_calificacion_lo($lo_id, $rep_id,$calificacion,$comentarios) {

        $today = date("Y-m-d");
        $hour= date("Y-m-d H:i:s");
        $session_data = $this->session->userdata('logged_in');

        $data = array(
            // 'lo_id'=> $this->base64_url_decode($lo_id),
            // 'rep_id'=> $this->base64_url_decode($rep_id),
            'use_sco_score'   => $this->input->post($calificacion),
            'use_sco_date'    => $today,
            // 'use_username' => $session_data['username'],
            'use_sco_time'    => $hour,
            'use_sco_comment' => $this->input->post($comentarios),
            );
        $this->db->where('use_username', $session_data['username']);
        $this->db->where('lo_id', $this->base64_url_decode($lo_id));
        $this->db->where('rep_id', $this->base64_url_decode($rep_id));
        $this->db->where('argument_code', $this->base64_url_decode($argument_code));
        $this->db->update('use_score', $data);


    }

    function validar_calificacion_lo($lo_id,$rep_id,$argument_code) {
        $lo= $this->base64_url_decode($lo_id);
        $rep= $this->base64_url_decode($rep_id);
        $arg_cd= $this->base64_url_decode($argument_code);
    
        $query = $this->db->query("select *  from use_score where lo_id='".$lo."' and rep_id='".$rep."' and argument_code='".$arg_cd."'");
        return $query->result_array();
    }


    function get_lo_qualified($username) {

        $query = $this->db->query("select *  from use_score where use_username='".$username."' ");
        return $query->result_array();
    }
    function get_lo_best_qualified($username) {

        $query = $this->db->query("select *  from use_score where use_sco_score >=4 and use_username='".$username."' ");
        return $query->result_array();
    }

    function get_best_oa($username) {

        $query = $this->db->query("select *  from use_score where use_sco_score >=4 AND use_username!='".$username."' ");
        return $query->result_array();
    }


    function get_all_lo() {

        $query = $this->db->query("select * from lo where lo_deleted='f'");
        $result= $query->result_array();
        return $result;
    }

    function get_lo_by_new() {

        $query = $this->db->query("select * from lo where lo_date > '2017-01-01' ");
        $result= $query->result_array();
        return $result;
    }


    function get_lo($lo_id,$rep_id) {

        $query = $this->db->query("select * from lo where lo_id='".$lo_id."' and rep_id='".$rep_id."'");
        $result= $query->result_array();
        return $result;
    }

    function comparate_lo($lo_id,$rep_id) {

        $query = $this->db->query("select * from lo where lo_id='".$lo_id."' and rep_id='".$rep_id."'");
        $result= $query->result_array();
        return $result;
    }


    function get_metadata($lo_id, $rep_id) {

        $query = $this->db->query("select lo_xml_lom from lo where lo_id='".$lo_id."' and rep_id='".$rep_id."'");

        return $query->result_array();


    }


    function set_visita_lo() {
        $query = $this->db->get_where('lo_visitas', array('lo_id' => $this->input->post("lo_id"),
            'rep_id' => $this->input->post("rep_id")));

        if ($query->num_rows() != 1) {
            $data = array(
                "lo_id" => $this->input->post("lo_id"),
                "rep_id" => intval($this->input->post("rep_id")),
                "logged" => intval($this->input->post("logged")),
                "clicked" => 1
            );

            $this->db->insert('lo_visitas', $data);
        } else {
            $lo = $this->input->post("lo_id");
            $rep = intval($this->input->post("rep_id"));
            $sql = "UPDATE lo_visitas 
                        SET clicked = (SELECT clicked FROM lo_visitas WHERE lo_id = '$lo' AND rep_id = $rep) + 1
                            WHERE lo_id = '$lo' AND rep_id = $rep;";
            //!!Verificar la referencia de fk_rep en la tabla lo_visitas esta desde lo y deberia ser desde rep.
            $this->db->query($sql);
        }
    }

    function get_rep_lo($rep_id){

        $query = $this->db->get_where('lo', array('rep_id' => $rep_id));
        return $query->result_array();

    }

    function get_lo_usr($username){

        $query = $this->db->query("SELECT lo.lo_id, lo.rep_id, lo_title, lo_language, lo_description,
                  lo_keyword, use_score.use_username FROM lo
                  JOIN use_score on use_score.lo_id = lo.lo_id AND use_score.rep_id = lo.rep_id
                  where use_username = '$username' ORDER BY use_score.use_sco_score  DESC");
        return $query->result_array();

    }

    function get_avg_score(){
        $lo = $this->input->post("lo_id");
        $rep = intval($this->input->post("rep_id"));
        $query = $this->db->query("SELECT AVG(use_sco_score) FROM use_score where
                                   lo_id = '$lo' AND rep_id = '$rep'");
        return $query->result_array();
    }

    public function titulos_recomendacion($idlom, $idrepository) {
        //recuperar los titulos y las localizaciones de los OAs resultado de la recomendación
        $this->db->select('lo_title, lo_location');
        $this->db->from('lo');
        $this->db->where('rep_id', $idrepository);
        $this->db->where('lo_id', $idlom);
        //$this->db->join('technical_location', 'lom.idlom = technical_location.idlom   and lom.idlom = technical_location.idlom and lom.idrepository = technical_location.idrepository', 'left');
        $query = $this->db->get();

        return $query->result_array();

    }

//    function get_metadata($lo_id, $rep_id) {
//
//
//        $query = $this->db->query("select lo_xml_lom from lo where lo_id = '$lo_id' AND rep_id = $rep_id");
//
//        return $query->result_array();
//    }
}
