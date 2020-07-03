<?php
/**
 * Created by PhpStorm.
 * User: leescobarg
 * Date: 19/09/14
 * Time: 12:15 PM
 */

class Test extends CI_Controller{
    function __construct(){
        parent::__construct ();
        $this->load->model("test_model");
        $this->load->helper('xml');
    }

    public function index(){
        echo "pruebas froac";
    }

    public function metadata_test(){
        $id_lo = "10";
        $id_rep = 69 ;
        $content = array(
            "xml" => $this->test_model->get_metadata($id_lo, $id_rep)
        );

        $this->load->view("base/metadata_view_test",$content);
    }


}