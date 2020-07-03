<?php

Class Lo extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("lo_model");
        $this->load->model("usuario_model");

    }

    public function index() {
        echo 'algo';
    }

    public function buscar_lo($params, $sess, $user) {
        $params = urldecode($params);
        $params = preg_replace('/_+/', '_', $params);
        if (substr($params, -1) == "_") {
            $params = substr($params, 0, -1);
        }

        //$params = $this->limpiar($params);
        $arrayParams = explode("_", $params);

        foreach ($arrayParams as $key => $value){

            if (substr($value, -3) == "ion" ){
                $arrayParams[$key] = substr($value,0, -3)."ión";
            }
        }

        $stopwordsConTildes = array("a", "acá", "ahí", "ajena", "ajenas", "ajeno", "ajenos", "al", "algo", "algún", "alguna", "algunas", "alguno", "algunos", "allá", "alli", "allí", "ambos", "ampleamos", "ante", "antes", "aquel", "aquella", "aquellas", "aquello", "aquellos", "aqui", "aquí", "arriba", "asi", "atras", "aun", "aunque", "bajo", "bastante", "bien", "cabe", "cada", "casi", "cierta", "ciertas", "cierto", "ciertos", "como", "cómo", "con", "conmigo", "conseguimos", "conseguir", "consigo", "consigue", "consiguen", "consigues", "contigo", "contra", "cual", "cuales", "cualquier", "cualquiera", "cualquieras", "cuan", "cuán", "cuando", "cuanta", "cuánta", "cuantas", "cuántas", "cuanto", "cuánto", "cuantos", "cuántos", "de", "dejar", "del", "demás", "demas", "demasiada", "demasiadas", "demasiado", "demasiados", "dentro", "desde", "donde", "dos", "el", "él", "ella", "ellas", "ello", "ellos", "empleais", "emplean", "emplear", "empleas", "empleo", "en", "encima", "entonces", "entre", "era", "eramos", "eran", "eras", "eres", "es", "esa", "esas", "ese", "eso", "esos", "esta", "estaba", "estado", "estais", "estamos", "estan", "estar", "estas", "este", "esto", "estos", "estoy", "etc", "fin", "fue", "fueron", "fui", "fuimos", "gueno", "ha", "hace", "haceis", "hacemos", "hacen", "hacer", "haces", "hacia", "hago", "hasta", "incluso", "intenta", "intentais", "intentamos", "intentan", "intentar", "intentas", "intento", "ir", "jamás", "junto", "juntos", "la", "largo", "las", "lo", "los", "mas", "más", "me", "menos", "mi", "mía", "mia", "mias", "mientras", "mio", "mío", "mios", "mis", "misma", "mismas", "mismo", "mismos", "modo", "mucha", "muchas", "muchísima", "muchísimas", "muchísimo", "muchísimos", "mucho", "muchos", "muy", "nada", "ni", "ningun", "ninguna", "ningunas", "ninguno", "ningunos", "no", "nos", "nosotras", "nosotros", "nuestra", "nuestras", "nuestro", "nuestros", "nunca", "os", "otra", "otras", "otro", "otros", "para", "parecer", "pero", "poca", "pocas", "poco", "pocos", "podeis", "podemos", "poder", "podria", "podriais", "podriamos", "podrian", "podrias", "por", "por qué", "porque", "primero", "primero desde", "puede", "pueden", "puedo", "pues", "que", "qué", "querer", "quien", "quién", "quienes", "quienesquiera", "quienquiera", "quiza", "quizas", "sabe", "sabeis", "sabemos", "saben", "saber", "sabes", "se", "segun", "ser", "si", "sí", "siempre", "siendo", "sin", "sín", "sino", "so", "sobre", "sois", "solamente", "solo", "somos", "soy", "sr", "sra", "sres", "sta", "su", "sus", "suya", "suyas", "suyo", "suyos", "tal", "tales", "también", "tambien", "tampoco", "tan", "tanta", "tantas", "tanto", "tantos", "te", "teneis", "tenemos", "tener", "tengo", "ti", "tiempo", "tiene", "tienen", "toda", "todas", "todo", "todos", "tomar", "trabaja", "trabajais", "trabajamos", "trabajan", "trabajar", "trabajas", "trabajo", "tras", "tú", "tu", "tus", "tuya", "tuyo", "tuyos", "ultimo", "un", "una", "unas", "uno", "unos", "usa", "usais", "usamos", "usan", "usar", "usas", "uso", "usted", "ustedes", "va", "vais", "valor", "vamos", "van", "varias", "varios", "vaya", "verdad", "verdadera", "vosotras", "vosotros", "voy", "vuestra", "vuestras", "vuestro", "vuestros", "y", "ya", "yo");
        $stopwordsSinTildes = array("a", "aca", "ahi", "ajena", "ajenas", "ajeno", "ajenos", "al", "algo", "algun", "alguna", "algunas", "alguno", "algunos", "alla", "alli", "alli", "ambos", "ampleamos", "ante", "antes", "aquel", "aquella", "aquellas", "aquello", "aquellos", "aqui", "aqui", "arriba", "asi", "atras", "aun", "aunque", "bajo", "bastante", "bien", "cabe", "cada", "casi", "cierta", "ciertas", "cierto", "ciertos", "como", "como", "con", "conmigo", "conseguimos", "conseguir", "consigo", "consigue", "consiguen", "consigues", "contigo", "contra", "cual", "cuales", "cualquier", "cualquiera", "cualquieras", "cuan", "cuan", "cuando", "cuanta", "cuanta", "cuantas", "cuantas", "cuanto", "cuanto", "cuantos", "cuantos", "de", "dejar", "del", "demas", "demas", "demasiada", "demasiadas", "demasiado", "demasiados", "dentro", "desde", "donde", "dos", "el", "el", "ella", "ellas", "ello", "ellos", "empleais", "emplean", "emplear", "empleas", "empleo", "en", "encima", "entonces", "entre", "era", "eramos", "eran", "eras", "eres", "es", "esa", "esas", "ese", "eso", "esos", "esta", "estaba", "estado", "estais", "estamos", "estan", "estar", "estas", "este", "esto", "estos", "estoy", "etc", "fin", "fue", "fueron", "fui", "fuimos", "gueno", "ha", "hace", "haceis", "hacemos", "hacen", "hacer", "haces", "hacia", "hago", "hasta", "incluso", "intenta", "intentais", "intentamos", "intentan", "intentar", "intentas", "intento", "ir", "jamas", "junto", "juntos", "la", "largo", "las", "lo", "los", "mas", "mas", "me", "menos", "mi", "mia", "mia", "mias", "mientras", "mio", "mio", "mios", "mis", "misma", "mismas", "mismo", "mismos", "modo", "mucha", "muchas", "muchisima", "muchisimas", "muchisimo", "muchisimos", "mucho", "muchos", "muy", "nada", "ni", "ningun", "ninguna", "ningunas", "ninguno", "ningunos", "no", "nos", "nosotras", "nosotros", "nuestra", "nuestras", "nuestro", "nuestros", "nunca", "os", "otra", "otras", "otro", "otros", "para", "parecer", "pero", "poca", "pocas", "poco", "pocos", "podeis", "podemos", "poder", "podria", "podriais", "podriamos", "podrian", "podrias", "por", "por que", "porque", "primero", "primero desde", "puede", "pueden", "puedo", "pues", "que", "que", "querer", "quien", "quien", "quienes", "quienesquiera", "quienquiera", "quiza", "quizas", "sabe", "sabeis", "sabemos", "saben", "saber", "sabes", "se", "segun", "ser", "si", "si", "siempre", "siendo", "sin", "sin", "sino", "so", "sobre", "sois", "solamente", "solo", "somos", "soy", "sr", "sra", "sres", "sta", "su", "sus", "suya", "suyas", "suyo", "suyos", "tal", "tales", "tambien", "tambien", "tampoco", "tan", "tanta", "tantas", "tanto", "tantos", "te", "teneis", "tenemos", "tener", "tengo", "ti", "tiempo", "tiene", "tienen", "toda", "todas", "todo", "todos", "tomar", "trabaja", "trabajais", "trabajamos", "trabajan", "trabajar", "trabajas", "trabajo", "tras", "tu", "tu", "tus", "tuya", "tuyo", "tuyos", "ultimo", "un", "una", "unas", "uno", "unos", "usa", "usais", "usamos", "usan", "usar", "usas", "uso", "usted", "ustedes", "va", "vais", "valor", "vamos", "van", "varias", "varios", "vaya", "verdad", "verdadera", "vosotras", "vosotros", "voy", "vuestra", "vuestras", "vuestro", "vuestros", "y", "ya", "yoz");
        foreach ($arrayParams as $key_p => $word) {
            foreach ($stopwordsSinTildes as $key_s => $stop) {
                if ($word == $stop) {
                    unset($arrayParams[$key_p]);
                }
            }
        }

        $palabras = implode(", ", $arrayParams);
        $params = implode("_", $arrayParams);
        $andParams = "('" . preg_replace('/_/', ' & ', $params) . "')";
        $orParams = "('" . preg_replace('/_/', ' | ', $params) . "')";
        $content = array(
            "result" => $this->lo_model->get_oas_b($orParams,$andParams),
            "palabras" => $palabras,
            "sess" => $sess,
            "user" => $user
        );
        $this->load->view("base/result_view",$content);
    }
       // print_r($andParams);
       // print_r($orParams);
     //   $oasencontrados = $this->lo_model->get_oas_b($orParams,$andParams);


       /* if ($this->session->userdata ( 'logged_in' )) {
            $d = 0;
            //print_r($oasencontrados);
            //echo ($oasencontrados[0][0]);
            foreach($oasencontrados[0] as $key){
                $x[$d]['idOA'] = $key["lo_id"];
                $x[$d]['idRepository'] = $key["rep_id"];
                $d++;
            }
            $session_data = $this->session->userdata('logged_in');
            $user = $session_data["username"];
            //print_r($session_data);
            //print_r($x);
            $content = array(
                "result" => $oasencontrados,
                "palabras" => $palabras,
                "sess" => $sess,
                "user" => $user,
                "oasadaptados" => $this->recomendacion($x, $user)
            );
        }else{

            $content = array(
                "result" => $oasencontrados,
                "palabras" => $palabras,
                "sess" => $sess,
                "user" => $user
            );
        }
        //print_r($oasencontrados);

        $this->load->view("base/result_view",$content);*/


    public function limpiar($cadena) {
        $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
        $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
        $texto = str_replace($no_permitidas, $permitidas, $cadena);
        return $texto;
    }


    public function load_metadata($id_lo, $id_rep){
        $cosa = $this->lo_model->get_metadata($id_lo, $id_rep);

        $content = array(
            "xml" => $cosa
        );

        $this->load->view("base/metadata_view",$content);

    }

    //Recomendación Paula
    /*protected function recomendacion($oas, $user){
        $parametros = array(
            'idUsuarioActivo' => $user,
            'OAs' => $oas
        );

        $wsdl_url = 'http://localhost:6020/ServicioWeb?wsdl';
        //$wsdl_url = 'http://froac.manizales.unal.edu.co:6020/ServicioWeb';
        $client = new SOAPClient($wsdl_url);
        $result = $client->adaptarOAs($parametros);
        $cadena = "";
        $otro = "";

        foreach ($result as $paulis) {
            foreach ($paulis as $no) {
                //echo $no->idOA . "-" . $no->idRepository . "$";

                $cadena = $cadena . $no->idOA . "-" . $no->idRepository . "$";
            }
        }
        //$this->llenar_recomendacion($p,$supone);
//        $this->llenar_recomendacion($result);
        return $cadena;
    }*/

    public function llenar_recomendacion($return1) {

        $return = urldecode($return1);

        $ob = explode("$", $return);
        $ob1 = array_pop($ob);
        $todos = array();
        foreach ($ob as $key) {
            $temp = explode("-", $key);
            $comp = array(
                'idOA' => $temp[0],
                'idRepository' => $temp[1]
            );
            array_push($todos, $comp);
        }
        //print_r($todos);


        //Con los id de los OAs recomendados, busco el titulo y la localización
        for ($i = 0; $i < count($todos); $i++) {
            $rec[$i] = $this->lo_model->titulos_recomendacion($todos[$i]['idOA'],$todos[$i]['idRepository']);
        }

        $data = array(
            "rec" => $rec
        );


        $this->load->view('base/llenar_recomendacion_view', $data);
    }



public function load_indicadores($id_lo, $id_rep, $username){

    echo $id_lo, $id_rep, $username;

}


public function set_visita(){
    $this->lo_model->set_visita_lo();
}


//Hacer que el usuario admin pueda ver los objetos
public function load_lo($url, $lo_name,$lo_id,$rep_id){

    if ($this->session->userdata('logged_in')) {
        $session_data = $this->session->userdata('logged_in');

        $content = [
            "user" => $session_data['username'],
            "usr_data" => $this->usuario_model->get_usr_data($session_data['username']),
            "usr_all_data" => $this->usuario_model->get_all_usr_data($session_data['username']),
            "main_view" => "base/lo_view",
            "sess" => 1,
            "lo_id" => $lo_id,
            "rep_id"=> $rep_id,
            "url" => $url,
            "lo_name" => $lo_name
        ];

        if ($session_data ['username'] == "admin"){
            $this->load->view('layouts/admin_template', $content);
        }else{
            $this->load->view('base/est_template', $content);
        }


    } else {
        $content = array(
            "main_view" => "base/lo_view",
            "sess" => 0,
            "url" => $url,
            "lo_name" => $lo_name
        );
        $this->load->view('base/est_template', $content);
    }
}


public function get_score_avg(){
    $result = $this->lo_model->get_avg_score();
    $avg = round($result[0]['avg']);
    echo $avg;
}

    public function calificarOA() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $rol = $this->usuario_model->get_rol ( $session_data ['username'] );
            $objetos=$this->lo_model->get_all_lo();
            $OAS= array();
            $x=rand(0,(count($objetos)));
            $objetos_calificados=$this->lo_model->get_lo_qualified($session_data ['username']);

            array_push($OAS,$objetos[$x]);

           // var_dump(count($objetos_calificados));

            if ($rol [0] ['use_rol_id'] == 2) {

                if (count($objetos_calificados)<=10){
                    $content = array(
                        "result" => $OAS,
                        "user" => $session_data ['username'],
                        "usr_data" => $this->usuario_model->get_usr_data ( $session_data ['username']),
                        "main_view" => "shared_views/calificarOA_view",
                        "encabezado" => "Calificar 10 Objetos  de Aprendizaje",
                        "url" => "lo/calificarOA/"
                    );
                    $this->load->view('base/est_template', $content);

                }
                else{

                    $content = array(
                        "user" => $session_data ['username'],
                        "usr_data" => $this->usuario_model->get_usr_data ( $session_data ['username']),
                        "main_view" => "shared_views/recomend_view",
                        "encabezado" => "Visualizar la recomendación",
                        "url" => "lo/recomend/"
                    );
                    $this->load->view('base/est_template', $content);
                }


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
                "main_view" => "shared_views/init_view",
            );
            $this->load->view('base/base_template', $content);
        }
    }

    public function guardar_calificacion($lo_id,$rep_id){
        if ( count($this->lo_model->validar_calificacion_lo($lo_id,$rep_id))==0) {
            //var_dump(count($this->lo_model->validar_calificacion_lo($lo_id,$rep_id)));
            $this->lo_model->guardar_calificacion_lo($lo_id, $rep_id);
            $this->calificarOA();
        }
        else{
            $calificacion=$this->input->post('calificacion');
            $comentarios=$this->input->post('comentarios');
            $this->update_oa($lo_id,$rep_id,$calificacion,$comentarios);

        }
    }

    // public function guardar_calificacion_argument($lo_id,$rep_id,$url,$title,$argument,$argument_type,$argument_code,$argument_number){
    public function guardar_calificacion_argument($lo_id,$rep_id,$url,$title,$argument,$argument_type,$argument_code,$argument_number,$calificacion,$comentarios,$evaluacion){

        
        $validar=$this->lo_model->validar_calificacion_lo($lo_id,$rep_id,$argument_code);
        
        
        if ( count($validar)==0) {
            $calificar_oa=$this->lo_model->guardar_calificacion_lo($lo_id,$rep_id,$argument_code,$calificacion,$comentarios);
        }
        else{
            $this->lo_model->update_calificacion_lo($lo_id,$rep_id,$argument_code,$calificacion,$comentarios);
        }
        
        $guardar_argumentacion=$this->lo_model->guardar_log($lo_id,$rep_id,$url,$title,$argument,$argument_type,$argument_code,$argument_number,$calificacion,$evaluacion);

    }
    
    public function guardar_calificacion_argument_aux(
        $lo_id,$rep_id,$url,$title,
        $argument,$argument_type,$argument_code,$argument_number,
        $argument1,$argument_type1,$argument_code1,$argument_number1,
        $argument2,$argument_type2,$argument_code2,$argument_number2,
        $argument3,$argument_type3,$argument_code3,$argument_number3
        
        ){
        // echo $lo_id;
        $save=$this->guardar_calificacion_argument($lo_id,$rep_id,$url,$title,$argument,$argument_type,$argument_code,$argument_number,'calificacion','comentarios','evaluacion');
        
        // verificar datos no vacios
        if($this->lo_model->base64_url_decode($argument1)!='ErrNothing' &&
           $this->input->post('evaluacion2')!=''){
            $save2=$this->guardar_calificacion_argument($lo_id,$rep_id,$url,$title,$argument1,$argument_type1,$argument_code1,$argument_number1,'calificacion2','comentarios2','evaluacion2');
            // echo "error 2";
            if($this->lo_model->base64_url_decode($argument2)!='ErrNothing' &&
            $this->input->post('evaluacion3')!=''){
                $save3=$this->guardar_calificacion_argument($lo_id,$rep_id,$url,$title,$argument2,$argument_type2,$argument_code2,$argument_number2,'calificacion3','comentarios3','evaluacion3');
                // echo "error 4";
                if($this->lo_model->base64_url_decode($argument3)!='ErrNothing' &&
                   $this->input->post('evaluacion4')!=''){
                    $save4=$this->guardar_calificacion_argument($lo_id,$rep_id,$url,$title,$argument3,$argument_type3,$argument_code3,$argument_number3,'calificacion4','comentarios4','evaluacion4');
                    // echo "error 5";
                }
            }
        }
        
        $this->recomendacion_global();

    }

  /*  public function error_duplicidad(){
        $session_data = $this->session->userdata('logged_in');

        $content = array(
            "user" => $session_data ['username'],
            "usr_data" => $this->usuario_model->get_usr_data ( $session_data ['username']),
            "main_view" => "shared_views/duplicidad_view",
            "encabezado" => "Duplicidad",
            "url" => "lo/duplicidad/"
        );
        $this->load->view('base/est_template', $content);
        }*/



public function update_oa($lo_id,$rep_id,$calificacion,$comentarios){
    $session_data = $this->session->userdata('logged_in');
    $this->lo_model->update_calificacion_lo($lo_id, $rep_id,$calificacion,$comentarios);
    $this->calificarOA();

}




    public function recomendacion_global()
    {
        $session_data = $this->session->userdata('logged_in');
        $objetos_calificados=$this->lo_model->get_lo_qualified($session_data ['username']);
       // var_dump($objetos_calificados);
        //$recommend=array();

        if(count($objetos_calificados)>=10){
          $content_recomendation=$this->recomendacion_contenido();
          $general_recomendation=$this->recomendacion_general();
          $knowlege_recomendation=$this->recomendacion_conocimiento();
          $demographic_recomendation=$this->recomendacion_demografico();

          $recommend=array_merge($content_recomendation,$general_recomendation,$knowlege_recomendation,$demographic_recomendation);


         sort($recommend);

          $random=array_rand($recommend,1);

          $arguments=array();

          for ($i=0;$i<=count($recommend)-1;$i++){

              if (array_column($recommend,'lo')[$random]==array_column($recommend,'lo')[$i] and
                  array_column($recommend,'rep')[$random]==array_column($recommend,'rep')[$i]){

                  array_push($arguments,['argument'=>array_column($recommend,'argument')[$i],'argument_type'=>array_column($recommend,'argument_type')[$i], 'argument_code'=>array_column($recommend,'argument_code')[$i], 'lo'=>array_column($recommend,'lo')[$i], 'rep'=>array_column($recommend,'rep')[$i], 'url'=>array_column($recommend,'url')[$i], 'title'=>array_column($recommend,'title')[$i]]);
              }
          }

         if (count($arguments)>=2){

              //var_dump(count($arguments),$random,$arguments);

             $content = array(
                 "result" => $arguments,
                 "url"=>base64_encode(array_column($arguments,'url')[0]),
                 "user" => $session_data ['username'],
                 "usr_data" => $this->usuario_model->get_usr_data ( $session_data ['username']),
                 "main_view" => "shared_views/recomendation_view",
                 "encabezado" => "OA Recomendado",
                 "url" => "lo/recomendation/"
             );
             $this->load->view('base/est_template', $content);


          }


        }
        else{
            $content = array(
                "user" => $session_data ['username'],
                "usr_data" => $this->usuario_model->get_usr_data ( $session_data ['username']),
                "main_view" => "shared_views/correction_view",
                "encabezado" => "Alerta",
                "url" => "lo/correction/"
            );
            $this->load->view('base/est_template', $content);

        }

        $recomendation= array();


    }

    public function recomendacion_general()
    {
        $session_data = $this->session->userdata('logged_in');
        $best_oa= $this->lo_model->get_best_oa($session_data ['username']);
        $recommend=array();
        $general_recomendation= array();
        //var_dump(count($best_oa));
        for ($i=0;$i<=count($best_oa)-1;$i++){
          //  var_dump(array_column($best_oa,'lo_id')[$i],array_column($best_oa,'rep_id')[$i]);

            $lo=$this->lo_model->get_lo(array_column($best_oa,'lo_id')[$i],array_column($best_oa,'rep_id')[$i]);


            array_push($recommend,['argument'=>'Este recurso puede interesarte porque su calidad es alta','argument_type'=>'General', 'argument_code'=>'G2','lo'=>array_column($lo,'lo_id')[0], 'rep'=>array_column($lo,'rep_id')[0], 'url'=>array_column($lo,'lo_location')[0], 'title'=>array_column($lo,'lo_title')[0]]);
        }

        $free_lo=$this->free();

        $general_recomendation=array_merge($recommend,$free_lo);

        return ($general_recomendation);



    }

    public function recomendacion_contenido()
    {
        $session_data = $this->session->userdata('logged_in');
        $oas_evaluated= $this->lo_model->get_lo_best_qualified($session_data ['username']);
        $similarity_total= array();
       // var_dump(array_column($oas_evaluated,'lo_id')[0],);
        for ($i=0;$i<=count($oas_evaluated)-1;$i++){
            $similarity=$this->lo_similarity($this->lo_model->get_lo(array_column($oas_evaluated,'lo_id')[$i],array_column($oas_evaluated,'rep_id')[$i]));
            array_push($similarity_total,$similarity);
        }
        $content_recomendation=array();
        for ($j=0;$j<=count($similarity_total)-1;$j++){

            for ($i=0;$i<=count($similarity_total[$j])-1;$i++){
                array_push($content_recomendation, $similarity_total[$j][$i]);
            }

        }
        return ($content_recomendation);

       // var_dump(($similarity_total[0])[0]);
        /*$content = array(
            "user" => $session_data ['username'],
            "OA"  => $similarity_total,
            "usr_data" => $this->usuario_model->get_usr_data ( $session_data ['username']),
            "main_view" => "shared_views/recommend",
            "encabezado" => "OA recomendado",
            "url" => "lo/recomment/"
        );
        $this->load->view('base/est_template', $content);*/

    //var_dump($similarity_total);
    }



    public function lo_similarity($lo_qualificated){

    //var_dump($lo_qualificated);
        $all_lo=$this->lo_model->get_all_lo();
        $similarity=array();
       // $similarity_total=array();
//var_dump($lo_qualificated[0]);

            for ($j=0;$j<=count($all_lo)-1;$j++){
                $features=array();
                if (array_column($lo_qualificated,'lo_id')[0] == array_column($all_lo,'lo_id')[$j] and array_column($lo_qualificated,'rep_id')[0]== array_column($all_lo,'rep_id')[$j]){

                    $j++;

                }
                else {
                    if (array_column($lo_qualificated, 'lo_language')[0] != null and array_column($all_lo, 'lo_language')[$j] != null) {
                        if (array_column($lo_qualificated, 'lo_language')[0] == array_column($all_lo, 'lo_language')[$j]) {
                            array_push($features, array_column($lo_qualificated, 'lo_language')[0]);
                        }
                    }
                    if (array_column($lo_qualificated, 'lo_structure')[0] != null and array_column($all_lo, 'lo_structure')[$j] != null) {
                        if (array_column($lo_qualificated, 'lo_structure')[0] == array_column($all_lo, 'lo_structure')[$j]) {
                            array_push($features, array_column($lo_qualificated, 'lo_structure')[0]);
                        }
                    }
                    if (array_column($lo_qualificated, 'lo_aggregationlevel')[0] != null and array_column($all_lo, 'lo_aggregationlevel')[$j] != null) {
                        if (array_column($lo_qualificated, 'lo_aggregationlevel')[0] == array_column($all_lo, 'lo_aggregationlevel')[$j]) {
                            array_push($features, array_column($lo_qualificated, 'lo_aggregationlevel')[0]);
                        }
                    }
                    if (array_column($lo_qualificated, 'lo_format')[0] != null and array_column($all_lo, 'lo_format')[$j] != null) {
                        if (array_column($lo_qualificated, 'lo_format')[0] == array_column($all_lo, 'lo_format')[$j]) {
                            array_push($features, array_column($lo_qualificated, 'lo_format')[0]);
                        }
                    }
                    if (array_column($lo_qualificated, 'lo_interactivitytype')[0] != null and array_column($all_lo, 'lo_interactivitytype')[$j] != null) {
                        if (array_column($lo_qualificated, 'lo_interactivitytype')[0] == array_column($all_lo, 'lo_interactivitytype')[$j]) {
                            array_push($features, array_column($lo_qualificated, 'lo_interactivitytype')[0]);
                        }
                    }
                    if (array_column($lo_qualificated, 'lo_learningresourcetype')[0] != null and array_column($all_lo, 'lo_learningresourcetype')[$j] != null) {
                        if (array_column($lo_qualificated, 'lo_learningresourcetype')[0] == array_column($all_lo, 'lo_learningresourcetype')[$j]) {
                            array_push($features, array_column($lo_qualificated, 'lo_learningresourcetype')[0]);
                        }
                    }
                    if (array_column($lo_qualificated, 'lo_interactivitylevel')[0] != null and array_column($all_lo, 'lo_interactivitylevel')[$j] != null) {
                        if (array_column($lo_qualificated, 'lo_interactivitylevel')[0] == array_column($all_lo, 'lo_interactivitylevel')[$j]) {
                            array_push($features, array_column($lo_qualificated, 'lo_interactivitylevel')[0]);
                        }
                    }
                    if (array_column($lo_qualificated, 'lo_difficulty')[0] != null and array_column($all_lo, 'lo_difficulty')[$j] != null) {
                        if (array_column($lo_qualificated, 'lo_difficulty')[0] == array_column($all_lo, 'lo_difficulty')[$j]) {
                            array_push($features, array_column($lo_qualificated, 'lo_difficulty')[0]);
                        }
                    }
                    if (count($features) > 7) {
                        array_push($similarity, ['argument'=>'Este recurso puede interesarte porque es similar a ('.array_column($lo_qualificated,'lo_title')[0].') que te gusto en el pasado', 'argument_type'=>'Contenido', 'argument_code'=>'C1','lo' => array_column($all_lo, 'lo_id')[$j], 'rep' => array_column($all_lo, 'rep_id')[$j], 'url'=>array_column($all_lo,'lo_location')[$j],'title'=>array_column($all_lo,'lo_title')[$j]]);
                    }
                }
                }
 //               array_push($similarity_total,['lo'=>array_column($lo_qualificated,'lo_id')[0],'rep'=>array_column($lo_qualificated,'rep_id')[0],'similare'=>$similarity]);

        //var_dump($similarity)[0];

            return $similarity;

            }



    public function recomendacion_demografico()
    {
        $similar_users=array();

        $session_data = $this->session->userdata('logged_in');

        $users=$this->usuario_model->get_all_users_data($session_data ['username']);

        $preferences=$this->usuario_model->get_preferencia_est($session_data ['username']);

        $user=$this->usuario_model->get_all_usr_data($session_data ['username']);

        $get_format_preferences= $this->lo_model->get_preferences_format($session_data['username']);

        $get_language_preferences= $this->lo_model->get_preferences_language($session_data['username']);



        for ($i=0;$i<=count($users)-1;$i++) {
            $bandera=0;

            $users_data = $this->usuario_model->get_all_usr_data(array_column($users, 'use_username')[$i]);

            $users_preferences = $this->usuario_model->get_preferencia_est(array_column($users, 'use_username')[$i]);

            $similar_preferences = $this->preferences($preferences, $users_preferences);

            $users_format_preferences = $this->lo_model->get_preferences_format(array_column($users, 'use_username')[$i]);

            $similar_format_preferences = $this->format_preferences($get_format_preferences, $users_format_preferences);

            $users_language_preferences = $this->lo_model->get_preferences_language(array_column($users, 'use_username')[$i]);

            $similar_language_preferences = $this->language_preferences($get_language_preferences, $users_language_preferences);


            if (array_column($users_data, 'use_level')[0] == array_column($user, 'use_level')[0]) {
                $bandera++;

            }
            if (array_column($users_data, 'use_ls_learningstyle')[0] == array_column($user, 'use_ls_learningstyle')[0]) {
                $bandera++;
            }
            if ($similar_preferences > 0) {
                $bandera++;
            }
            if ($similar_format_preferences>0) {
                $bandera++;
            }
            if ($similar_language_preferences>0) {
                $bandera++;
            }

            if ($bandera>=3){

                array_push($similar_users,array_column($users, 'use_username')[$i]);
            }

        }


        $recommend=$this->get_lo_by_users($similar_users);

        //var_dump($recommend);

        return $recommend;



    }

    public function recomendacion_conocimiento()
    {
        $knowlege_recomendation=array();

        $session_data = $this->session->userdata('logged_in');

        //$similar_users = $this->usuario_model->get_similar_users($session_data ['username']);

        $get_format_preferences= $this->lo_model->get_preferences_format($session_data['username']);

        $format_preferences= $this->format(array_column($get_format_preferences,'use_format'));

        $get_language_preferences= $this->lo_model->get_preferences_language($session_data['username']);

        $language_preferences=$this->language(array_column($get_language_preferences,'use_language'));

        $structure_preferences= $this->structure();

        $new_lo=$this->new_lo();

        $user_ls=$this->usuario_model->get_all_usr_data($session_data['username']);

        $ls=$this->ls_recommend(array_column($user_ls,'use_ls_learningstyle')[0]);

        $knowlege_recomendation=array_merge($format_preferences,$language_preferences,$structure_preferences,$new_lo,$ls);

        return $knowlege_recomendation;


    }


    public function preferences($preference_a,$preference_b)
    {
        $contador=0;

        if (count($preference_a)==0 or count($preference_b)==0){

            return $contador;
        }
        else{
        for ($i=0;$i<=count($preference_a)-1;$i++){

            for ($j=0;$j<=count($preference_b)-1;$j++){

                if (array_column($preference_a,'use_pre_preferencia')[$i]==array_column($preference_b,'use_pre_preferencia')[$j]){
                    $contador++;
                }
            }
        }

        return $contador;}

    }


    public function format_preferences($preference_a,$preference_b)
    {
        $contador=0;

        if (count($preference_a)==0 or count($preference_b)==0){

            return $contador;
        }
        else{
            for ($i=0;$i<=count($preference_a)-1;$i++){

                for ($j=0;$j<=count($preference_b)-1;$j++){

                    if (array_column($preference_a,'use_format')[$i]==array_column($preference_b,'use_format')[$j]){
                        $contador++;
                    }
                }
            }

            return $contador;}

    }


    public function language_preferences($preference_a,$preference_b)
    {
        $contador=0;

        if (count($preference_a)==0 or count($preference_b)==0){

            return $contador;
        }
        else{
            for ($i=0;$i<=count($preference_a)-1;$i++){

                for ($j=0;$j<=count($preference_b)-1;$j++){

                    if (array_column($preference_a,'use_language')[$i]==array_column($preference_b,'use_language')[$j]){
                        $contador++;
                    }
                }
            }

            return $contador;}

    }


    public function get_lo_by_users($users){

    $lo=array();

    for($i=0;$i<=count($users)-1;$i++){

        $oas_evaluated= $this->lo_model->get_lo_best_qualified(($users)[$i]);


        for ($j=0;$j<=count($oas_evaluated)-1;$j++){

           $lo_data=$this->lo_model->get_lo(array_column($oas_evaluated,'lo_id')[$j],array_column($oas_evaluated,'rep_id')[$j]);
            array_push($lo, ['argument'=>'Este recurso puede interesarte porque le gustó a usuarios similares a ti.', 'argument_type'=>'Demográfico','argument_code'=>'D1','lo' => array_column($lo_data, 'lo_id')[0], 'rep' => array_column($lo_data, 'rep_id')[0], 'url'=>array_column($lo_data,'lo_location')[0],'title'=>array_column($lo_data,'lo_title')[0]]);
        }

    }

        return $lo;

    }

    public function format($format_preferences){

    //var_dump($format_preferences[0]);
        $recommend=array();
    for ($i=0;$i<=count($format_preferences)-1;$i++) {
        $oa = $this->lo_model->get_oa_by_format($format_preferences[$i]);
        for ($j=0;$j<=count($oa)-1;$j++){
            //var_dump(array_column($oa,'lo_format')[$j]);
            array_push($recommend, ['argument'=>'Este recurso puede interesarte porque se ajusta a tu preferencia de formato ('.array_column($oa,'lo_format')[$j].').', 'argument_type'=>'Conocimiento','argument_code'=>'K1','lo' => array_column($oa, 'lo_id')[$j], 'rep' => array_column($oa, 'rep_id')[$j], 'url'=>array_column($oa,'lo_location')[$j],'title'=>array_column($oa,'lo_title')[$j]]);
        }
    }
    return ($recommend);

    }


    public function language($language_preferences){

       // var_dump($language_preferences);
        $recommend=array();
        for ($i=0;$i<=count($language_preferences)-1;$i++) {
            $oa = $this->lo_model->get_oa_by_language($language_preferences[$i]);
            for ($j=0;$j<=count($oa)-1;$j++){
                //var_dump(array_column($oa,'lo_format')[$j]);
                array_push($recommend, ['argument'=>'Este recurso puede interesarte porque se ajusta a tu preferencia de idioma('.array_column($oa,'lo_language')[$j].').', 'argument_type'=>'Conocimiento','argument_code'=>'K4','lo' => array_column($oa, 'lo_id')[$j], 'rep' => array_column($oa, 'rep_id')[$j], 'url'=>array_column($oa,'lo_location')[$j],'title'=>array_column($oa,'lo_title')[$j]]);
            }
        }
        return ($recommend);

    }

    public function structure(){

        $get_structure_preferences= $this->lo_model->get_preferences_structure();

        $recommend=array();

            for ($j=0;$j<=count($get_structure_preferences)-1;$j++){
                //var_dump(array_column($oa,'lo_format')[$j]);
                array_push($recommend, ['argument'=>'Este recurso puede interesarte porque es auto contenido.', 'argument_type'=>'Conocimiento', 'argument_code'=>'K3','lo' => array_column($get_structure_preferences, 'lo_id')[$j], 'rep' => array_column($get_structure_preferences, 'rep_id')[$j], 'url'=>array_column($get_structure_preferences,'lo_location')[$j],'title'=>array_column($get_structure_preferences,'lo_title')[$j]]);
            }

        return ($recommend);

    }

    public function ls_recommend($ls){

    $recommend=array();

    if ($ls!=null) {

        if ($ls=='Auditivo-Global'){

            $oa1= $this->lo_model->get_oa_by_format('mp4');
            $oa2= $this->lo_model->get_oa_by_format('wmv');

            $recomendation=array_merge($oa1,$oa2);
        }

        if ($ls=='Auditivo-Secuencial'){

            $oa1= $this->lo_model->get_oa_by_format('mp4');
            $oa2= $this->lo_model->get_oa_by_format('wmv');

            $recomendation=array_merge($oa1,$oa2);

        }

        if ($ls=='Kinestesico-Global'){

            $oa1= $this->lo_model->get_oa_by_format('exe');
            $oa2= $this->lo_model->get_oa_by_format('html');
            $oa3= $this->lo_model->get_oa_by_format('rar');
            $oa4= $this->lo_model->get_oa_by_format('zip');
            $oa5= $this->lo_model->get_oa_by_format('7z');

            $recomendation=array_merge($oa1,$oa2,$oa3,$oa4,$oa5);

        }

        if ($ls=='Kinestesico-Secuencial'){

            $oa1= $this->lo_model->get_oa_by_format('exe');
            $oa2= $this->lo_model->get_oa_by_format('html');
            $oa3= $this->lo_model->get_oa_by_format('rar');
            $oa4= $this->lo_model->get_oa_by_format('zip');
            $oa5= $this->lo_model->get_oa_by_format('7z');

            $recomendation=array_merge($oa1,$oa2,$oa3,$oa4,$oa5);
        }

        if ($ls=='Lector-Global'){

            $oa1= $this->lo_model->get_oa_by_format('PDF');
            $oa2= $this->lo_model->get_oa_by_format('html');

            $recomendation=array_merge($oa1,$oa2);
        }

        if ($ls=='Lector-Secuencial'){

            $oa1= $this->lo_model->get_oa_by_format('PDF');
            $oa2= $this->lo_model->get_oa_by_format('html');

            $recomendation=array_merge($oa1,$oa2);

        }

        if ($ls=='Visual-Global'){

            $oa1= $this->lo_model->get_oa_by_format('mp4');
            $oa2= $this->lo_model->get_oa_by_format('wmv');
            $oa3= $this->lo_model->get_oa_by_format('svg');
            $oa4= $this->lo_model->get_oa_by_format('jpg');
            $oa5= $this->lo_model->get_oa_by_format('PNG');
            $oa6= $this->lo_model->get_oa_by_format('ppt');

            $recomendation=array_merge($oa1,$oa2,$oa3,$oa4,$oa5,$oa6);

        }
        if ($ls=='Visual-Secuencial'){

            $oa1= $this->lo_model->get_oa_by_format('mp4');
            $oa2= $this->lo_model->get_oa_by_format('wmv');
            $oa3= $this->lo_model->get_oa_by_format('svg');
            $oa4= $this->lo_model->get_oa_by_format('jpg');
            $oa5= $this->lo_model->get_oa_by_format('PNG');
            $oa6= $this->lo_model->get_oa_by_format('ppt');

            $recomendation=array_merge($oa1,$oa2,$oa3,$oa4,$oa5,$oa6);

        }

        for ($i=0;$i<=count($recomendation)-1;$i++){

            array_push($recommend, ['argument'=>'Este recurso puede interesarte porque se ajusta a tu estilo de aprendizaje:'.$ls.' .', 'argument_type'=>'Conocimiento', 'argument_code'=>'K2','lo' => array_column($recomendation, 'lo_id')[$i], 'rep' => array_column($recomendation, 'rep_id')[$i], 'url'=>array_column($recomendation,'lo_location')[$i],'title'=>array_column($recomendation,'lo_title')[$i]]);

        }

    }
    else{
        $recommend=0;

    }

    return $recommend;


    }


    public function free(){

        $get_oas= $this->lo_model->get_all_lo();

        $recommend=array();

        for ($j=0;$j<=count($get_oas)-1;$j++){
            //var_dump(array_column($oa,'lo_format')[$j]);
            array_push($recommend, ['argument'=>'Este recurso puede interesarte porque es libre.', 'argument_type'=>'General', 'argument_code'=>'G1','lo' => array_column($get_oas, 'lo_id')[$j], 'rep' => array_column($get_oas, 'rep_id')[$j], 'url'=>array_column($get_oas,'lo_location')[$j],'title'=>array_column($get_oas,'lo_title')[$j]]);
        }

        return ($recommend);

    }


    public function new_lo(){

        $get_oas= $this->lo_model->get_lo_by_new();


        $recommend=array();

        for ($j=0;$j<=count($get_oas)-1;$j++){
            //var_dump(array_column($oa,'lo_format')[$j]);
            array_push($recommend, ['argument'=>'Este recurso puede interesarte porque es actual.', 'argument_type'=>'Conocimiento','argument_code'=>'K5','lo' => array_column($get_oas, 'lo_id')[$j], 'rep' => array_column($get_oas, 'rep_id')[$j], 'url'=>array_column($get_oas,'lo_location')[$j],'title'=>array_column($get_oas,'lo_title')[$j]]);
        }

        return ($recommend);

    }







}
