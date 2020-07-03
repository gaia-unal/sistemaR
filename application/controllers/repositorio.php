<?php

class Repositorio extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model("repositorio_model");
        $this->load->model("lo_model");
        $this->load->model("usuario_model");//Import al modelo de la clase
    }

    public function index(){
        $this->lista();

    }

    public function lista() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $content = array(
                "main_view" => "shared_views/lista_rep_view",
                "user" => $session_data ['username'],
                "usr_data" => $this->usuario_model->get_usr_data ( $session_data ['username'] ),
                "repos" => $this->repositorio_model->get_repos(),
                "flag"  => "repo",
                "encabezado" => "Resultados del repositorio",
                "url" => "repositorio/lista/"
            );
            if ($session_data ['username'] == "admin"){
                $this->load->view('base/admin_template', $content);
            }else{

                $this->load->view('base/est_template', $content);
            }

        } else {
            $content = array(
                "main_view" => "shared_views/lista_rep_view",
                "repos" => $this->repositorio_model->get_repos(),
                "flag"  => "repo",
                "encabezado" => "Resultados del repositorio",
                "url" => "repositorio/lista/"
            );
            $this->load->view('base/base_template', $content);
        }
    }



     public function registrar_repo() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data = array(
                'username' => $session_data['username'],
                "title" => "Registro Repositorios",
                "titulo" => "Administrador",
                "user" => $session_data['username'],
                "main" => "admin/nuevo_repo_view",
                "page" => "Registro",
                "usuario" => $this->repo_model->get_user_repo()
            );
            $this->load->view('include/adm_template1', $data);
        } else {
            //If no session, redirect to login page
            redirect('init', 'refresh');
        }
    }

    public function lo_rep($rep_id){
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $content = array(
                "result" => $this->lo_model->get_rep_lo($rep_id),
                "sess" => 1,
                "user" => $session_data['username'],
                "main_view" => "shared_views/result_view_st",
                "url" => "repositorio/lista/",
                "encabezado" => "Resultados de el repositorio",
            );
            $this->load->view("base/base_template",$content);
        } else {
            $content = array(
                "result" => $this->lo_model->get_rep_lo($rep_id),
                "sess" => 0,
                "main_view" => "shared_views/result_view_st",
                "url" => "repositorio/lista/",
                "encabezado" => "Resultados de el repositorio",
            );
            $this->load->view("base/base_template",$content);
        }

    }

    //Agregar Repositorio --- Lleva a la vista
    public function nuevo(){
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in')) {
            if ($session_data ['username'] == "admin"){

                $content = array(
                    "main_view" => "admin/nuevo_repo_view",
                    "user" => $session_data ['username'],
                    "usr_data" => $this->usuario_model->get_usr_data ( $session_data ['username'] ),
                    "usuarios" => $this->repositorio_model->get_user_repo()
                );
            }
            $this->load->view('base/admin_template', $content);
        }else {
            $this->lista();
        }
    }

	//Guardar en nuevo Repositorio --- Lleva al modelo
	public function insert_repo() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if ($this->input->post('tiporepositorio') == 'ROAp') {
                $this->repositorio_model->insertar_repo_roap();
            } else {
                $this->repositorio_model->insertar_repo();
            }

            $this->lista();
        } else {
            //If no session, redirect to login page
            redirect('init', 'refresh');
        }
    }

    //Modificar un repositorio --- Lleva a la vista
    public function modificar_repo($rep_id) {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $content = array(
                'username' => $session_data['username'],
                "title" => "Modificar Repositorio",
                "titulo" => "Administrador",
                "user" => $session_data['username'],
                "main_view" => "admin/modificar_repo_view",
                "page" => "Modificación",
                "repomod" => $this->repositorio_model->get_repo_mod($rep_id),
                "usuario" => $this->repositorio_model->get_user_repo()
            );
            $this->load->view('base/admin_template', $content);
        } else {
            //If no session, redirect to login page
            redirect('init', 'refresh');
        }
    }

    //Modificar repositori --- Lleva al modelo
    public function actualizar_repo() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $this->repositorio_model->modificar_repo();
            $this->lista();
        } else {
            //If no session, redirect to login page
            redirect('init', 'refresh');
        }
    }

    //Esta función es utilizada para el proceso de cosechado. Lo que hace es ir hasta el Servlet que realiza las peticiones OAI
    public function cosechado($actualizar, $idrepository, $lastupdate, $cadenaoai, $metadata, $fechainicio, $fechafin) {
        //echo "Sale por este lado"+$actualizar;

        if ($actualizar == "1") //Todo
            $url = "http://localhost:8080/harvesterFROAC/HarvesterOAI?cadenaOAI=" . $cadenaoai . "&idROA=" . $idrepository . "&metadata=" . $metadata . "&fechainicio=&fechafin=";
        if ($actualizar == "2") //Ultima Actualización
            $url = "http://localhost:8080/harvesterFROAC/HarvesterOAI?cadenaOAI=" . $cadenaoai . "&idROA=" . $idrepository . "&metadata=" . $metadata . "&fechainicio=" . $lastupdate . "&fechafin=";
        if ($actualizar == "3") //Rango de Fechas
            $url = "http://localhost:8080/harvesterFROAC/HarvesterOAI?cadenaOAI=" . $cadenaoai . "&idROA=" . $idrepository . "&metadata=" . $metadata . "&fechainicio=" . $fechainicio . "&fechafin=" . $fechafin . "";
        /* if ($actualizar == "1") //Todo
          $url = "http://froac.manizales.unal.edu.co:8080/harvesterFROAC/HarvesterOAI?cadenaOAI=" . $cadenaoai . "&idROA=" . $idrepository . "&metadata=" . $metadata . "&fechainicio=&fechafin=";
          if ($actualizar == "2") //Ultima Actualización
          $url = "http://froac.manizales.unal.edu.co:8080/harvesterFROAC/HarvesterOAI?cadenaOAI=" . $cadenaoai . "&idROA=" . $idrepository . "&metadata=" . $metadata . "&fechainicio=" . $lastupdate . "&fechafin=";
          if ($actualizar == "3") //Rango de Fechas
          $url = "http://froac.manizales.unal.edu.co:8080/harvesterFROAC/HarvesterOAI?cadenaOAI=" . $cadenaoai . "&idROA=" . $idrepository . "&metadata=" . $metadata . "&fechainicio=" . $fechainicio . "&fechafin=" . $fechafin . "";
         */
        $tags = get_meta_tags($url);
        return $tags;
    }

    public function actualizar_oas() 
    {
        global $idrepository;
        $idrepository = $this->input->post("idrepository");
        $lastupdate = $this->input->post("lastupdate");
        $cadenaoai = $this->input->post("cadenaoai");
        $metadata = $this->input->post("metadata");
        $actualizar = $this->input->post("actualizar");
        $fechainicio = $this->input->post("fechainicio");
        $fechafin = $this->input->post("fechafin");
        $resp = $this->cosechado($actualizar, $idrepository, $lastupdate, $cadenaoai, $metadata, $fechainicio, $fechafin);
        //Verifica que sí se generaran XML... lo que retorna la función "cosechado"
        if (count($resp) > 0) {

            //Se recorre el vector que tiene las url de los xml
            foreach ($resp as $res) {
                //Ubicación de los archivos xml
                //$url= base_url()."harvester/".$idrepository."_".($i+1).".xml";
                //Ejemplo --- $url = "http://froac.manizales.unal.edu.co/harvester/FROAC-11.xml";
                $url = $res;

                //Se carga el contenido del archivo xml en $doc
                $doc = new DOMDocument();
                $doc->load($url);
                //Verifico el estándar de metadatos a analizar
                if ($metadata == "lom") {
                    //Se recorre el xml record por record
                    $oas = $doc->getElementsByTagName('record');
                    //Tenemos un vector de 'record' en la variable $oas y se recorre
                    foreach ($oas as $oa) {
                        $header = $oa->getElementsByTagName('header');
                        global $lo_id;
                        $lo_id = $header->item(0)->getElementsByTagName('identifier')->item(0)->nodeValue;
                        $status = $header->item(0)->getAttribute('status');
                        $datestamp = $header->item(0)->getElementsByTagName('datestamp')->item(0)->nodeValue;
                        $xmlo = '';
                        //Si el estado del record no es 'deleted' obtengo el xml
                        if ($status != 'deleted') {
                            $xmlo0 = $oa->getElementsByTagName('lom');
                            $xmlo1 = $xmlo0->item(0);
                            $xml = $xmlo1->ownerDocument->saveXML($xmlo1);
                            $xmlo = $xml;
                        }

                        //Hago select para determinar la operación a realizar -- Miro si ya existía el OA
                        $consult = $this->repositorio_model->get_lo($idrepository, $lo_id); //---- Consultar si existe en la tabla 'lo' un objeto con ese lo_id y rep_id
                        $vlr = sizeof($consult);
                        $last = "";
                        if ($vlr == 0) {
                            //Quiere decir que no existe un registro de ese OA, entonces lo inserto si no se ha eliminado
                            if ($status != 'deleted') {
                                $data = array(
                                    'rep_id' => $idrepository,
                                    'lo_id' => $lo_id,
                                    'lo_insertiondate' => date("Y-m-d"),
                                    'lo_deleted' => 'false',
                                    'lo_lastmodified' => $datestamp,
                                    'lo_xml_lom' => $xmlo
                                );
                                $this->repositorio_model->insert_table($data, 'lo'); //---- Insertar en la tabla 'lo' lo correspondiente 
                            }
                        } 
                        else 
                        {
                            foreach ($consult as $consu) {
                                $last = $consu['lo_lastmodified'];
                            }
                            //Quiere decir que ya existe un registro de ese OA, entonces debo actualizarlo
                            if ($status != 'deleted') {
								//Ya existe registro y no se ha eliminado, sino modificado
                                if ($last != $lo_lastmodified) {
                                    //Datos que se van a modificar
                                    $data = array(
                                        'lo_lastmodified' => $lo_lastmodified,
                                        'lo_xml_lom' => $xmlo 
                                    );

                                    //Capos para poner en el where
                                    $campos = array(
                                        '0' => 'rep_id',
                                        '1' => 'lo_id'
                                    );

                                    //Valores para poner en el where
                                    $valores = array(
                                        '0' => $rep_id,
                                        '1' => $lo_id
                                    );

                                    $this->repositorio_model->update_table($data, 'lo', $campos, $valores); //---- Modifica en la tabla 'lo' lo correspondiente 

                                }
                            } 
							else 
							{
                                $data = array(
                                    'lo_deleted' => 'true',
                                    'lo_lastmodified' => $datestamp,
                                    'lo_xml_lom' => $xmlo
                                );
                                //Capos para poner en el where
                                $campos = array(
                                    '0' => 'rep_id',
                                    '1' => 'lo_id'
                                );

                                //Capos para poner en el where
                                $valores = array(
                                    '0' => $idrepository,
                                    '1' => $lo_id
                                );

                                $this->repositorio_model->update_table($data, 'lo', $campos, $valores);
                            }
                        }
                        if ($status != 'deleted') {
                            if ($last != $datestamp) {
                                $meta = $oa->getElementsByTagName('metadata')->item(0);
                                $this->importGeneral($meta, $idrepository, $lo_id);
                                $this->importLifeCycle($meta, $idrepository, $lo_id);
                                $this->importTechnical($meta, $idrepository, $lo_id);
                                $this->importEducational($meta, $idrepository, $lo_id);
                            }
                        }
                    }//foreach     
                }//if    
            }//for
        }//if
        $this->lista();
    }
	
	///////////////////// GENERAL  /////////////
	function importGeneral($meta, $idrepository, $idlom) {
        $tagGeneral = $meta->getElementsByTagName('general');
		$title="";
		$language="";
		$description="";
		$keyword = "";
		$structure = "";
		$aggregationlevel = "";
        foreach ($tagGeneral as $general) {
            /***************************Title***************************/
            $titlet = $general->getElementsByTagName('title')->item(0)->nodeValue;
			$title = $title."/".$titlet;
			
            /***************************Language***********************/
            $tagLanguaje = $general->getElementsByTagName('language');
            foreach ($tagLanguaje as $l) {
                $lang = $l->nodeValue;
				$language = $language."/".$lang;
            }
			
            /*************************Description**************************/
            $tagDescription = $general->getElementsByTagName('description');
            foreach ($tagDescription as $d) {
                $descri = $d->nodeValue;
				$description = $description."/".$descri;
            }
			
            /*************************Keyword**************************/
            $tagKeyword = $general->getElementsByTagName('keyword');
            foreach ($tagKeyword as $k) {
                $key = $k->nodeValue;
				$keyword = $keyword."/".$key;
            }
			
            /**************************Structure************************** */
            $structuret = $general->getElementsByTagName('structure')->item(0)->nodeValue;
			$structure = $structure."/".$structuret;
			
            /**************************Aggregationlevel************************** */
            $aggregationlevelt = $general->getElementsByTagName('aggregationlevel')->item(0)->nodeValue;
			$aggregationlevel = $aggregationlevel."/".$aggregationlevelt;
		}
		$title = substr($title,1);
		$language = substr($language,1);
		$description = substr($description,1);
		$keyword = substr($keyword,1);
		$structure = substr($structure,1);
		$aggregationlevel = substr($aggregationlevel,1);
		
            //Con esta sección almaceno en la tabla lo
            $data = array(
                'lo_title' => $title,
				'lo_language' => $language,
				'lo_description' => $description,
				'lo_keyword' => $keyword,
				'lo_structure' => $structure,
				'lo_aggregationlevel' => $aggregationlevel
            );
            //Capos para poner en el where
            $campos = array(
                '0' => 'rep_id',
                '1' => 'lo_id'
            );

            //Capos para poner en el where
            $valores = array(
                '0' => $idrepository,
                '1' => $idlom
            );

            $this->repositorio_model->update_table($data, 'lo', $campos, $valores);
    }
	
	///////////////////// L I F E   C Y C L E/////////////
    function importLifeCycle($meta, $idrepository, $idlom) 
	{
		$tagLifecycle = $meta->getElementsByTagName('lifecycle');
		$date="";
		$entity="";
        foreach ($tagLifecycle as $lifecycle) {
            /***************************Contribute***************************/
            $tagContribute = $lifecycle->getElementsByTagName('contribute');
            foreach ($tagContribute as $contribute) {
                $datet = $contribute->getElementsByTagName('date')->item(0)->nodeValue;
				$date = $date."/".$datet;
				
				$role = $contribute->getElementsByTagName('role')->item(0)->nodeValue;
				if($role == "author")
				{
					$tagEntity = $contribute->getElementsByTagName('entity');
					foreach ($tagEntity as $e) {
						$enti = $e->nodeValue;
						$entity = $entity."/".$enti;
					}
				}
            }
		}
		$date = substr($date,1);
		$entity = substr($entity,1);

        //Con esta sección almaceno en la tabla lo
        $data = array(
            'lo_author' => $entity,
            'lo_date' => $date
        );
        //Capos para poner en el where
        $campos = array(
            '0' => 'rep_id',
            '1' => 'lo_id'
        );
        //Capos para poner en el where
        $valores = array(
            '0' => $idrepository,
            '1' => $idlom
        );
        $this->repositorio_model->update_table($data, 'lo', $campos, $valores);
    }
	
	///////////////////// T E C H N I C A L /////////////
    function importTechnical($meta, $idrepository, $idlom) {
        $tagTechnical = $meta->getElementsByTagName('technical');
		$format="";
		$location="";
        foreach ($tagTechnical as $technical) {
            /***************************Format************************** */
            $tagFormat = $technical->getElementsByTagName('format');
            foreach ($tagFormat as $f) {
                $form = $f->nodeValue;
				$format = $format."/".$form;
            }
            /**************************Location************************** */
            $tagLocation = $technical->getElementsByTagName('location');
            foreach ($tagLocation as $l) {
                $locat = $l->nodeValue;
				$location = $location."/".$locat;
            }
        }
		$format = substr($format,1);
		$location = substr($location,1);

        //Con esta sección almaceno en la tabla lo
        $data = array(
            'lo_format' => $format,
            'lo_location' => $location
        );
        //Capos para poner en el where
        $campos = array(
            '0' => 'rep_id',
            '1' => 'lo_id'
        );
        //Capos para poner en el where
        $valores = array(
            '0' => $idrepository,
            '1' => $idlom
        );
        $this->repositorio_model->update_table($data, 'lo', $campos, $valores);
    }
	
	///////////////////// E D U C A T I O N A L /////////////
    function importEducational($meta, $idrepository, $idlom) {
        $tagEducational = $meta->getElementsByTagName('educational');
		$interactivitytype = "";
		$learningresourcetype = "";
		$interactivitylevel = "";
		$difficulty = "";
        foreach ($tagEducational as $educational) {
            /**************************Interactivitytype************************** */
            $interactivitytypet = $educational->getElementsByTagName('interactivitytype')->item(0)->nodeValue;
			$interactivitytype = $interactivitytype."/".$interactivitytypet;
			
            /**************************Learningresourcetype************************** */
            $tagLearningresourcetype = $educational->getElementsByTagName('learningresourcetype');
            foreach ($tagLearningresourcetype as $lrt) {
                $resourcetype = $lrt->nodeValue;
				$learningresourcetype = $learningresourcetype."/".$resourcetype;
            }
			
            /**************************Interactivitylevel************************** */
            $interactivitylevelt = $educational->getElementsByTagName('interactivitylevel')->item(0)->nodeValue;
			$interactivitylevel = $interactivitylevel."/".$interactivitylevelt;
			
            /**************************Difficulty************************** */
            $difficultyt = $educational->getElementsByTagName('difficulty')->item(0)->nodeValue;
			$difficulty = $difficulty."/".$difficultyt;
		}
		
		$interactivitytype = substr($interactivitytype,1);
		$learningresourcetype = substr($learningresourcetype,1);
		$interactivitylevel = substr($interactivitylevel,1);
		$difficulty = substr($difficulty,1);
		
        //Con esta sección almaceno en la tabla lom metadatos que no son multivaluados
        $data = array(
            'lo_interactivitytype' => $interactivitytype,
            'lo_learningresourcetype' => $learningresourcetype,
            'lo_interactivitylevel' => $interactivitylevel,
            'lo_difficulty' => $difficulty
        );
        //Capos para poner en el where
        $campos = array(
            '0' => 'rep_id',
            '1' => 'lo_id'
        );
        //Capos para poner en el where
        $valores = array(
            '0' => $idrepository,
            '1' => $idlom
        );
		$this->repositorio_model->update_table($data, 'lo', $campos, $valores);
	}
}

