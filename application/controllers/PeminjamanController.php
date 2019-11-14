<?php
    class PeminjamanController extends CI_Controller {
        function __construct() {
            parent:: __construct();

            $this->load->model("PeminjamanModel");
            $this->load->model("LoginModel");
            $this->load->library("session");

            if ($this->session->userdata("login") != TRUE) {
                echo '
                        <script>
                            alert("Login Dulu!");
                            window.location = "'.base_url('index.php/LoginController').'";
                        </script>
                        ';
            } 
        }


        function index() {
            $data["data"] = $this->PeminjamanModel->showAll();
            $data["judul_content"] = "Daftar Peminjaman";
            $data["isi_content"] = "PeminjamanIndexView";

            $this->load->view("default", $data);
        }
    }

?>