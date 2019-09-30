<?php
	class Inventarisir extends CI_Controller{
		function index (){
			$data ['judul_content'] = 'Inventarisir';
			$data ['isi_content']	= 'inventarisir_index';
			$this->load->view('default', $data);
		}
	}