<?php
    class LaporanController extends CI_Controller {
        function __construct() {
            parent:: __construct();
        }

        function pdfInventaris() {
            $mpdf = new \Mpdf\Mpdf();
            $html = $this->load->view('LaporanInventarisView', [], true);
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
    }
?>