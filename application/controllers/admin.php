<?php



class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct ();
        $this->load->model ( "usuario_model" );
        $this->load->model ( "admin_model" );
    }

    public function index() {
        if ($this->session->userdata ( 'logged_in' )) {
            $session_data = $this->session->userdata ( 'logged_in' );
            $rol = $this->usuario_model->get_rol ( $session_data ['username'] );
            if ($rol [0] ['use_rol_id'] == 1) {
                $content = array (
                    "user" => $session_data ['username'],
                    "usr_data" => $this->usuario_model->get_usr_data ( $session_data ['username'] ),
                    "main_view" => "admin/dashboard",
                    "total_user" => $this->admin_model->get_total_user(),
                    "total_rep" => $this->admin_model->get_total_rep(),
                    "total_lo" => $this->admin_model->get_total_lo(),
                    "total_lo_score" => $this->admin_model->get_total_lo_score(),
                );
                $this->load->view ( 'base/admin_template', $content );
            } else {
                $content = array (
                    "main_view" => "shared_views/init_view"
                );
                $this->load->view ( 'base/base_template', $content );
            }
        } else {
            $content = array (
                "main_view" => "shared_views/init_view"
            );
            $this->load->view ( 'base/base_template', $content );
        }
    }


    public function lista_user(){
        if ($this->session->userdata ( 'logged_in' )) {
            $session_data = $this->session->userdata ( 'logged_in' );
            $rol = $this->usuario_model->get_rol ( $session_data ['username'] );
            if ($rol [0] ['use_rol_id'] == 1) {
                $content = array (
                    "user" => $session_data ['username'],
                    "usr_data" => $this->usuario_model->get_usr_data ( $session_data ['username'] ),
                    "main_view" => "admin/lista_user",
                    "users" => $this->admin_model->get_users()
                );
                $this->load->view ( 'base/admin_template', $content );
            } else {
                $content = array (
                    "main_view" => "base/init_view"
                );
                $this->load->view ( 'base/base_template', $content );
            }
        } else {
            $content = array (
                "main_view" => "base/init_view"
            );
            $this->load->view ( 'base/base_template', $content );
        }

    }

    /**
     * @param string $username Se recibe como nombre de usuario para tata
     */
    public function editar_usr($username){
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $rol = $this->usuario_model->get_rol ( $session_data ['username'] );
            if ($rol [0] ['use_rol_id'] == 1) {
                $content = array(
                    "user" => $session_data['username'],
                    "usr_data" => $this->usuario_model->get_usr_data($username),
                    "usr_all_data" => $this->usuario_model->get_all_usr_data($username),
                    "main_view" => "admin/editar_view",
                    "rol" => $this->usuario_model->get_rol_data()
                );
                $this->load->view('base/admin_template', $content);
            } else {
                redirect(base_url(), 'refresh');
            }

        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function delete_usr($username){
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $rol = $this->usuario_model->get_rol ( $session_data ['username'] );
            if ($rol [0] ['use_rol_id'] == 1) {
                $this->admin_model->del_usr($username);
                $this->lista_user();
            } else {
                redirect(base_url(), 'refresh');
            }

        } else {
            redirect(base_url(), 'refresh');
        }
    }

    function update_user(){
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

            $this->usuario_model->update_user($this->input->post("username"));
            $this->lista_user();

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
}