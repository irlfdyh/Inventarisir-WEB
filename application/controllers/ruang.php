<?php

    class ruang extends CI_Controller{

        function __construct(){
            parent::__construct();
            $this->load->model('ruang_model');
        }

        function index(){
            $data['judul_content'] = 'JENIS_RUANG';
            $data['isi_content'] = 'ruang_index';
            $data['data'] = $this->ruang_model->showAll();

            $this->load->view('default', $data);
        }
        
    }
?>