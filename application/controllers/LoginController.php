<?php

    class LoginController extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->model("LoginModel");
            $this->load->library("session");
        }

        function index() {
            $this->load->view("LoginView");
        }

        function execute() {

            $username = $this->input->post("username");
            $password = $this->input->post("password");

            $checkAccount = $this->LoginModel->checkAccount(
                $username, $password
            );

            if($checkAccount->num_rows()>0) {
                $row = $checkAccount->row_array();
                
                $this->session->set_userdata("id_level", $row["id_level"]);
                $this->session->set_userdata("id_petugas", $row["id_petugas"]);
                $this->session->set_userdata("login", TRUE);

                echo '
                        <script>
                            alert("Berhasil Masuk");
                            window.location = "'.base_url('index.php/inventaris').'";
                        </script>
                        ';
            } else {
                echo '
                        <script>
                            alert("Gagal Masuk");
                            window.location = "'.base_url('index.php/LoginController').'";
                        </script>
                    ';
            }
        }

        function destroy() {
            $this->session->sess_destroy();
            echo '
                    <script>
                        alert("You Are Logged Out");
                        window.location = "'.base_url('index.php/LoginController').'";
                    </script>
                ';
        }
    }


?>