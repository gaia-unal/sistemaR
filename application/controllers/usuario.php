<?php

//Clase Usuario, encargada de todas las operaciones y
//metodos de los usuarios.

class Usuario extends CI_Controller {


    //Metodo constructor de la clase
    public function __construct() {
        parent::__construct();
        $this->load->model("usuario_model");//Import al modelo de la clase
        $this->load->model("lo_model");//Import al modelo lo_model
    }

    //Metodo para obtener datos basicos del usuario
    public function get_usr_data($username) {
        $this->load->view('base/login_view');
    }

///metodo que carga la vista acerca
    public function acerca() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $rol = $this->usuario_model->get_rol ( $session_data ['username'] );
            if ($rol [0] ['use_rol_id'] == 2) {
                $content = array(
                "main_view" => "shared_views/acerca_view",
                "encabezado" => "Acerca de",
                "url" => "usuario/acerca/"
                );

        $this->load->view('base/est_template', $content);
    }
    else{
        $content = array(
                "main_view" => "shared_views/acerca_view",
                "encabezado" => "Acerca de",
                "url" => "usuario/acerca/"
                );

        $this->load->view('base/base_template', $content);

    }
} else {
            $content = array(
                "main_view" => "shared_views/acerca_view",
                "encabezado" => "Acerca de",
                "url" => "usuario/acerca/"
                );

        $this->load->view('base/base_template', $content);
        }
    }

//metodo que carga el test de estilos de aprendizaje

    public function estilos() {
        $content = array(
            "main_view" => "shared_views/estilos_view",
                "encabezado" => "Test Estilos de Aprendizaje",
                "url" => "usuario/estilos/"
        );
        $this->load->view('base/est_template', $content);
    }

//metodo que carga el equipo de trabajo de froac
    public function equipo() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $rol = $this->usuario_model->get_rol ( $session_data ['username'] );
            if ($rol [0] ['use_rol_id'] == 2) {
                $content = array(
                "main_view" => "shared_views/equipo_view",
                "encabezado" => "Equipo FROAC",
                "url" => "usuario/equipo/"
            );
                $this->load->view('base/est_template', $content);
    }
    else{
        $content = array(
                "main_view" => "shared_views/equipo_view",
                "encabezado" => "Equipo FROAC",
                "url" => "usuario/equipo/"
            );
                $this->load->view('base/base_template', $content);

    }
} else {
            $content = array(
                "main_view" => "shared_views/equipo_view",
                "encabezado" => "Equipo FROAC",
                "url" => "usuario/equipo/"
            );
                $this->load->view('base/base_template', $content);
        }
    }



    public function glosario() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $rol = $this->usuario_model->get_rol ( $session_data ['username'] );


            if ($rol [0] ['use_rol_id'] == 2) {
                $content = array(
                "main_view" => "shared_views/glosario_view",
                "encabezado" => "Glosario",
                "url" => "usuario/glosario/"
            );
                $this->load->view('base/est_template', $content);
    }
    else{
        $content = array(
                "main_view" => "shared_views/glosario_view",
                "encabezado" => "Glosario",
                "url" => "usuario/glosario/"
            );
                $this->load->view('base/base_template', $content);

    }
} else {
             $content = array(
                "main_view" => "shared_views/glosario_view",
                "encabezado" => "Glosario",
                "url" => "usuario/glosario/"
            );
                $this->load->view('base/base_template', $content);
        }
    }

    //Metodo que carga la pagina de inicio de sesión
    public function login() {
        $this->load->view('base/login_view');
    }

    //Metodo para crear una nueva cuenta
    public function registro(){

        if ($this->session->userdata('logged_in')) {
            redirect(base_url(), 'refresh');//Definir que pasa si ya esta loggeado
        } else {
            $content = array(
                "preferencias" => $this->usuario_model->get_preferencias(),
                "nivel_educativo" => $this->usuario_model->get_nivel_educativo(),
                "main_view" => "register/registro_view"
            );
            $this->load->view('base/base_template', $content);
        }
    }

    public function busqueda(){
        if ($this->session->userdata('logged_in')) {
            redirect(base_url(), 'refresh');//Definir que pasa si ya esta loggeado
        } else {
            $content = array(
                "preferencias" => $this->usuario_model->get_preferencias(),
                "nivel_educativo" => $this->usuario_model->get_nivel_educativo(),
                "main_view" => "shared_views/busqueda_avanzada_view"
            );
            $this->load->view('base/base_template', $content);
        }
    }

    //Metodo que muestra el perfil del usuario.
    public function perfil() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $rol = $this->usuario_model->get_rol ( $session_data ['username'] );
            if ($rol [0] ['use_rol_id'] == 1) {
                $content = array(
                    "user" => $session_data['username'],
                    "usr_data" => $this->usuario_model->get_usr_data($session_data['username']),
                    "usr_all_data" => $this->usuario_model->get_all_admin_data($session_data['username']),
                    "main_view" => "admin/perfil_view"
                );
                $this->load->view('base/admin_template', $content);
            } else {
                if ($rol [0] ['use_rol_id'] == 5) {
                    $content = array(
                        "user" => $session_data['username'],
                        "usr_data" => $this->usuario_model->get_usr_data($session_data['username']),
                        "usr_all_data" => $this->usuario_model->get_all_admin_data($session_data['username']),
                        "main_view" => "admin/perfil_view"
                    );
                    $this->load->view('base/rep_template', $content);
                }else {
                    $content = array(
                        "user" => $session_data['username'],
                        "usr_data" => $this->usuario_model->get_usr_data($session_data['username']),
                        "usr_all_data" => $this->usuario_model->get_all_usr_data($session_data['username']),
                        "main_view" => "usr/perfil_view"
                    );
                    $this->load->view('base/est_template', $content);
                }
            }

        } else {
            redirect(base_url(), 'refresh');
        }
    }


    /**
     * Esta función envía el correo electronico ingresado a la función "verify_email" de usuario_model
     * para verificar si ya existe en la base de datos
     */
     public function verify_email(){

        $mail = $_POST["mail"];
        $mail = strtolower($mail);
        $result = $this->usuario_model->verify_email($mail);
        print_r($result);
    }

    // Método que guarda los datos de un usuario al ser registrado desde el administrador

    public function nuevo_usuario(){
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in')) {
            if ($session_data ['username'] == "admin"){

                $content = array(
                    "main_view" => "admin/nuevo_user_view",
                    "user" => $session_data ['username'],
                    "usr_data" => $this->usuario_model->get_usr_data ( $session_data ['username'] ),
                    //"usuarios" => $this->repositorio_model->get_user_repo()
                    "rol" => $this->usuario_model->get_rol_data()
                );
            }
            $this->load->view('base/admin_template', $content);
        }else {
            $this->lista();
        }
    }

    //Metodo que establece la calificación de los usuarios para cada
    //OA parametros cadena = "lo_id, rep_id, lo_score, username"
    function set_score(){

        $this->usuario_model->save_score();

    }

    function get_score(){
        $score = $this->usuario_model->get_score();
        echo $score[0]["use_sco_score"];
    }

    /**
     * Esta función envía el nombre de usuario ingresado a la función "verify_username" de usuario_model
     * para verificar si ya existe en la base de datos
     */
    public function verify_username(){

        $username = $_POST["username"];
        $username = strtolower($username);
        $result = $this->usuario_model->verify_username($username);
        print_r($result);
    }

    public function save_user(){

        $this->usuario_model->guardar_usuario();
        $this->login();

    }
/*
    public function xml_service(){

        $this->load->view('shared_views/xml_service');
    }


    public function search_service($params){
        $content = array(
            "main_view" => "shared_views/service_view",
                "encabezado" => "This XML file does not appear to have any style information associated with it. The document tree is shown below.",
                "url" => "usuario/search_service/"
                "metadatos"=> $this->usuario_model->get_metadatos($params);
        );
            $this->load->view('base/base_template', $content);
    }

*/
    public function editar_usr(){
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $rol = $this->usuario_model->get_rol ( $session_data ['username'] );
            if ($rol [0] ['use_rol_id'] == 1) {
                $content = array(
                    "user" => $session_data['username'],
                    "usr_data" => $this->usuario_model->get_usr_data($session_data['username']),
                    "usr_all_data" => $this->usuario_model->get_all_usr_data($session_data['username']),
                    "main_view" => "admin/perfil_view"
                );
                $this->load->view('base/admin_template', $content);
            } else {
                $content = array(
                    "user" => $session_data['username'],
                    "usr_data" => $this->usuario_model->get_usr_data($session_data['username']),
                    "usr_all_data" => $this->usuario_model->get_all_usr_data($session_data['username']),
                    "main_view" => "usr/editar_view"
                );
                $this->load->view('base/est_template', $content);
            }

        } else {
            redirect(base_url(), 'refresh');
        }
    }

    function update_user(){
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

            $this->usuario_model->update_user($session_data["username"]);
            $this->perfil();
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function chpasswd(){
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $this->load->view("usr/chpasswd_view");

        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function verificar_passwd() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $res = $this->usuario_model->verificar_passwd(md5($_POST["passwd"]),$session_data["username"]);
            if ($res == 1) {
                echo 1;
            }elseif ($res == 0) {
                echo 0;
            }
        } else {
            redirect(base_url(), 'refresh');
        }


    }

    function upd_passwd(){
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $this->usuario_model->actualizar_passwd(md5($_POST["passwd_new"]),$session_data["username"]);
            $this->session->unset_userdata('logged_in');
            redirect(base_url(), 'refresh');

        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function mis_objetos(){

        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

                $content = array(
                    "user" => $session_data['username'],
                    "usr_data" => $this->usuario_model->get_usr_data($session_data['username']),
                    "usr_all_data" => $this->usuario_model->get_all_usr_data($session_data['username']),
                    "main_view" => "base/result_view_st",
                    "encabezado" => "Objetos calificados",
                    "url" => "usuario/perfil/",
                    "result" => $this->lo_model->get_lo_usr($session_data['username']),
                    "sess" => 1
                );
                $this->load->view('base/est_template', $content);


        } else {
            redirect(base_url(), 'refresh');
        }

    }

    public function mail(){

        // El mensaje
        $mensaje = "Línea 1\r\nLínea 2\r\nLínea 3";

        // Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
        $mensaje = wordwrap($mensaje, 70, "\r\n");

        // Enviarlo
        mail('leegixus@gmail.com', 'Mi título', $mensaje);

    }


    //Metodo que guarda los registros cuando se crea una cuenta por parte del estudiante,
    // en la tabla usuario y estudiante

    public function guardar() {

        $this->usuario_model->guardar_estudiante();
        foreach ($_POST['pref'] as $key => $value) {
            $this->usuario_model->insert_pref($value, $this->input->post('username'));
        }
        foreach ($_POST['format'] as $key => $value) {
            $this->usuario_model->insert_format($value, $this->input->post('username'));
        }

        foreach ($_POST['language'] as $key => $value) {
            $this->usuario_model->insert_language($value, $this->input->post('username'));
        }

        if($_POST["necesidadespecial"]!=""){
            $this->usuario_model->has_need($this->input->post('username'));
            $need_vision = null;
            $need_visiondescri = null;
            $need_audicion = "no";
            $need_audiciondescri = null;
            $need_motriz = "no";
            $need_motrizdescri = null;
            $need_coginitiva = "no";
            $need_cognitivatexto = "no";
            $need_cognitivainstru = "no";
            $need_cognitivaconcentra = "no";

            $need = $_POST["necesidadespecial"];

            $need1 = explode(",", $need);
            //print_r($need1);
            if(count($need1)>0){
                for($i = 0; $i<count($need1); $i++){
                    if(strpos($need1[$i], "Vision")!==false){
                        if($need1[$i]=="Vision-Nula"){
                            $need_vision = "si";
                        }else{
                            if(strpos($need1[$i],"Vision-Parcial")!==false){
                                $need_vision = "si";
                                $need_visiondescri = substr($need1[$i],-3);
                            }
                        }

                    }

                    if(strpos($need1[$i], "Audicion")!==false){
                        $need_audicion = "si";
                        if(strpos($need1[$i], "Señas-Texto")!==false){
                            $need_audiciondescri = "señas-texto";
                        }else{
                            if(strpos($need1[$i], "Señas")!==false){
                                $need_audiciondescri = "señas";
                            }else{
                                if(strpos($need1[$i], "Texto")!==false){
                                    $need_audiciondescri = "texto";
                                }
                            }
                        }



                    }

                    if(strpos($need1[$i], "Motriz")!==false){
                        $need_motriz = "si";
                        if(strpos($need1[$i], "Mouse-Teclado")!==false){
                            $need_motrizdescri = "mouse-teclado";
                        }else{
                            if(strpos($need1[$i], "Mouse")!==false){
                                $need_motrizdescri = "mouse";
                            }
                            else{

                                if(strpos($need1[$i], "Teclado")!==false){
                                    $need_motrizdescri = "teclado";
                                }
                            }
                        }



                    }

                    if(strpos($need1[$i], "Cognitivo")!==false){
                        $need_coginitiva = "si";
                        if(strpos($need1[$i], "ConcentraSi")!==false){
                            $need_cognitivatexto = "si";

                        }else{
                            if(strpos($need1[$i], "TextoSi")!==false){
                                $need_cognitivainstru = "si";

                            }  else{
                                if(strpos($need1[$i], "InstruccionesSi")!==false){
                                    $need_cognitivaconcentra = "si";
                                }
                            }
                        }



                    }
                }

                $this->usuario_model->update_has_need($this->input->post('username'),$need_vision,
                    $need_visiondescri, $need_audicion, $need_audiciondescri,
                    $need_motriz, $need_motrizdescri, $need_coginitiva, $need_cognitivatexto,
                    $need_cognitivainstru, $need_cognitivaconcentra);
            }else{
                if(strpos($need1[0], "Vision")!==false){
                    if($need1[0]=="Vision-Nula"){
                        $need_vision = "si";
                    }else{
                        if(strpos($need1[0],"Vision-Parcial")!==false){
                            $need_visiondescri = substr($need1[0],-3);
                        }
                    }

                }

                if(strpos($need1[0], "Audicion")!==false){
                    $need_audicion = "si";
                    if(strpos($need1[0], "Señas-Texto")!==false){
                        $need_audiciondescri = "señas-texto";
                    }else{
                        if(strpos($need1[0], "Señas")!==false){
                            $need_audiciondescri = "señas";
                        } else{
                            if(strpos($need1[$i], "Texto")!==false){
                                $need_audiciondescri = "texto";
                            }
                        }
                    }


                }

                if(strpos($need1[0], "Motriz")!==false){
                    $need_motriz = "si";
                    if(strpos($need1[0], "Mouse-Teclado")!==false){
                        $need_motrizdescri = "mouse-teclado";
                    }else{
                        if(strpos($need1[0], "Mouse")!==false){
                            $need_motrizdescri = "mouse";
                        }else{
                            if(strpos($need1[0], "Teclado")!==false){
                                $need_motrizdescri = "teclado";
                            }
                        }
                    }


                }

                if(strpos($need1[0], "Cognitivo")!==false){
                    $need_coginitiva = "si";
                    if(strpos($need1[0], "ConcentraSi")!==false){
                        $need_cognitivatexto = "si";

                    }else{
                        if(strpos($need1[0], "TextoSi")!==false){
                            $need_cognitivainstru = "si";

                        }else{
                            if(strpos($need1[0], "InstruccionesSi")!==false){
                                $need_cognitivaconcentra = "si";
                            }

                        }
                    }


                }
                $this->usuario_model->update_has_need($this->input->post('username'),$need_vision,
                    $need_visiondescri, $need_audicion, $need_audiciondescri,
                    $need_motriz, $need_motrizdescri, $need_coginitiva, $need_cognitivatexto,
                    $need_cognitivainstru, $need_cognitivaconcentra);
            }
        }
        $name = $this->input->post('nombre') . ' ' . $this->input->post('apellido');
        $this->exito($this->input->post('username'), $name);
    }

    // Metodo que muestra un mensaje de exito cuando se crea una cuenta correctamente

    public function exito($id, $name) {

        $content = array(
            "title" => "Registro éxitoso",
            "main_view" => "register/exito_view",
            "username" => $id,
            "name" => $name
        );
        $this->load->view('base/base_template', $content);
    }

    /*public function test_result() {

        $this->clasificaresp();
    }*/

    // Metodo que calcula el resultado del Test de Estilo de Aprendizaje

    public function test_result() {
        $cant_V = 0;
        $cant_A = 0;
        $cant_R = 0;
        $cant_K = 0;

        $cant_G = 0;
        $cant_S = 0;

        for ($i = 1; $i <= 13; $i++) {
            if ($this->input->post($i) == 'V')
                $cant_V++;

            if ($this->input->post($i) == 'A')
                $cant_A++;

            if ($this->input->post($i) == 'R')
                $cant_R++;

            if ($this->input->post($i) == 'K')
                $cant_K++;
        }
        /*
          echo '   Cantidad de V    ';
          echo $cant_V;

          echo '   Cantidad de A    ';
          echo $cant_A;

          echo '   Cantidad de R    ';
          echo $cant_R;

          echo '   Cantidad de K    ';
          echo $cant_K; */

        //GLOBAL _ SECUENCIAL

        for ($j = 49; $j <= 70; $j++) {
            if ($this->input->post($j) == 'G')
                $cant_G++;
            if ($this->input->post($j) == 'S')
                $cant_S++;
        }

    /*$this->usuario_model->guardar_estudiante($cant_V,$cant_A,$cant_R,$cant_K,$cant_G,$cant_S);

        /* echo "   cantidad G  ";
          echo $cant_G;
          echo "   cantidad S  ";
          echo $cant_S; */

        // $mayor = "";

        $puntaje = 0;
        if ($cant_V >= $cant_A && $cant_V >= $cant_R && $cant_V >= $cant_K) {
            $mayor = 7; //Visual
            $puntaje = $cant_V;
        } else
        if ($cant_A >= $cant_V && $cant_A >= $cant_R && $cant_A >= $cant_K) {
            $mayor = 1; //Auditivo
            $puntaje = $cant_A;
        } else
        if ($cant_R >= $cant_V && $cant_R >= $cant_A && $cant_R >= $cant_K) {
            $mayor = 5; //Lector
            $puntaje = $cant_R;
        } else
        if ($cant_K >= $cant_R && $cant_K >= $cant_V && $cant_K >= $cant_A) {
            $mayor = 3; //kinestesico
            $puntaje = $cant_K;
        }

        if ($cant_G >= $cant_S) {
            $mayor = $mayor + 0; //Global
            $puntaje = $puntaje . '-' . $cant_G;
        } else {
            $mayor = $mayor + 1; //Secuencial
            $puntaje = $puntaje . ' - ' . $cant_S;
        }

        $datos = array($mayor,$cant_V,$cant_A,$cant_R,$cant_K,$cant_G,$cant_S);

        echo json_encode($datos);#$mayor.",".$cant_V.",".$cant_A.",".$cant_R.",".$cant_K.",".$cant_G.",".$cant_S;
        /*

esta es una opción que dio valen usando javascrip en la cual se manda la variable mayor y las
6 variables cant en una cadena serada por un caracter especial para desde la vista desarmar la
cadena y enviar al modelo estos valores
        echo $mayor."&".$cant_K;*/


        //echo 'Su estilo de aprendizaje es: ' . $mayor . ' con un resultado de ' . $puntaje;
       // $data = $this->input->post('1');
        // $data = json_decode(stripslashes($_POST['1']),true);
        //echo $data;

        //$this->usuario_model->guardar_test();
    }


    /**
     * Esta Función guarda los resultados del test para personas con necesidades especiales
     */
   public function test_need()
   {
       $discapacidades = array();
       //Resultados de limitación Visual
       for ($i = 7; $i <= 8; $i++) {
           if ($this->input->post($i) == 'Vision Nula') {
               $discapacidades[] = array("Vision Nula" => "Si");
               $resultadoVisual = "Visión Nula";
           } else {
               $discapacidades[] = array("Vision Nula" => "No");
               if ($this->input->post($i + 1) == 'Tamaño 1.1') {
                   $discapacidades[] = array("Vision Tamaño 1.1" => "Si");
                   $resultadoVisual = "1.1";
               } else {
                   $discapacidades[] = array("Vision Tamaño 1.1" => "No");
                   if ($this->input->post($i + 1) == 'Tamaño 1.3') {
                       $discapacidades[] = array("Vision Tamaño 1.3" => "Si");
                       $resultadoVisual = "1.3";
                   } else {
                       $discapacidades[] = array("Vision Tamaño 1.3" => "No");
                       if ($this->input->post($i + 1) == 'Tamaño 1.7') {
                           $discapacidades[] = array("Vision Tamaño 1.7" => "Si");
                           $resultadoVisual = "1.7";
                       } else {
                           $discapacidades[] = array("Vision Tamaño 1.7" => "No");
                           if($this->input->post($i + 1) == 'Tamaño 2.0'){
                               $discapacidades[] = array("Vision Tamaño 2.0" => "Si");
                               $resultadoVisual = "2.0";
                           }else{
                               $discapacidades[] = array("Vision Tamaño 2.0" => "No");
                           }

                       }
                   }
               }

           }
       }


        //Resultados de Limitación Auditiva

       for ($i = 9; $i <= 11; $i++) {
           if ($this->input->post($i) == 'Audicion Nula') {
               $discapacidades[] = array("Audicion Nula" => "Si");
               $resultadoAuditivo = "Audición Nula";
           } else {
               $discapacidades[] = array("Audicion Nula" => "No");
               if ($this->input->post($i) == 'Baja Audicion') {
                   $discapacidades[] = array("Baja Audicion" => "Si");
                   $resultadoAuditivo = "Baja Audicion";
               }
           }
           if ($this->input->post($i) == 'Si Lenguaje') {
               $discapacidades[] = array("Si Lenguaje" => "Si");
               $resultadoAuditivo1 = "Lenguaje de Señas";
           }
           if ($this->input->post($i) == 'Si Idioma') {
               $discapacidades[] = array("Si Idioma" => "Si");
               $resultadoAuditivo2 = "Español";
           }
       }

        //Resultados de Limitación Motriz

       for ($i = 12; $i <= 13; $i++) {
           if ($this->input->post($i) == 'No mouse') {
               $discapacidades[] = array("No mouse" => "Si");
               $resultadoMotriz = "Mouse";
           }

           if ($this->input->post($i) == 'No teclado') {
               $discapacidades[] = array("No teclado" => "Si");
               $resultadoMotriz1 = "Teclado";
           }

       }

        //Resultados de Limitación Cognitiva

       for ($i = 13; $i <= 17; $i++) {
           if ($this->input->post($i) == 'No concentra') {
               $discapacidades[] = array("No concentra" => "Si");
               $resultadoCognitivo="Concentra";
           }
           if ($this->input->post($i) == 'No texto') {
               $discapacidades[] = array("No texto" => "Si");
               $resultadoCognitivo1="Texto";
           }
           if ($this->input->post($i) == 'No instrucciones') {
               $discapacidades[] = array("No instrucciones" => "Si");
               $resultadoCognitivo2 = "Instrucciones";
           }

           if ($this->input->post($i) == 'No distrae') {
               $discapacidades[] = array("No distrae" => "Si");
               $resultadoCognitivo3 = "No se distrae";
           }

       }
   }


   /*
    public function up_test() {
        $cant_V = 0;
        $cant_A = 0;
        $cant_R = 0;
        $cant_K = 0;

        $cant_G = 0;
        $cant_S = 0;

        for ($i = 1; $i <= 13; $i++) {
            if ($this->input->post($i) == 'V')
                $cant_V++;

            if ($this->input->post($i) == 'A')
                $cant_A++;

            if ($this->input->post($i) == 'R')
                $cant_R++;

            if ($this->input->post($i) == 'K')
                $cant_K++;
        }

        //GLOBAL _ SECUENCIAL

        for ($j = 49; $j <= 70; $j++) {
            if ($this->input->post($j) == 'G')
                $cant_G++;
            if ($this->input->post($j) == 'S')
                $cant_S++;
        }


        $puntaje = 0;
        if ($cant_V >= $cant_A && $cant_V >= $cant_R && $cant_V >= $cant_K) {
            $mayor = 7; //Visual
            $puntaje = $cant_V;
        } else
        if ($cant_A >= $cant_V && $cant_A >= $cant_R && $cant_A >= $cant_K) {
            $mayor = 1; //Auditivo
            $puntaje = $cant_A;
        } else
        if ($cant_R >= $cant_V && $cant_R >= $cant_A && $cant_R >= $cant_K) {
            $mayor = 5; //Lector
            $puntaje = $cant_R;
        } else
        if ($cant_K >= $cant_R && $cant_K >= $cant_V && $cant_K >= $cant_A) {
            $mayor = 3; //kinestesico
            $puntaje = $cant_K;
        }

        if ($cant_G >= $cant_S) {
            $mayor = $mayor + 0; //Global
            $puntaje = $puntaje . '-' . $cant_G;
        } else {
            $mayor = $mayor + 1; //Secuencial
            $puntaje = $puntaje . ' - ' . $cant_S;
        }

       $this->usuario_model->update_test($mayor,$cant_V,$cant_A,$cant_R,$cant_K,$cant_G,$cant_S,  $session_data['username']);
        else{
                        //If no session, redirect to login page
            redirect('init', 'refresh');

        }

    }*/




}
