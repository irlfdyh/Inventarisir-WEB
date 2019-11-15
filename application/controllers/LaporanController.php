<?php
    class LaporanController extends CI_Controller {
        function __construct() {
            parent:: __construct();

            $this->load->model("inventaris_model");
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

        function pdfInventaris() {
            $data["data"] = $this->inventaris_model->showAll();

            $mpdf = new \Mpdf\Mpdf();
            $html = $this->load->view('LaporanInventarisView', $data);
            $mpdf->WriteHTML($html);
            $mpdf->Output();

            // foreach ($data as $data) {
            //     $this->table->add_row($no. );

            // }
        }
    }
?>