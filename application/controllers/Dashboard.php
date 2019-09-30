<?php
	class Dashboard extends CI_Controller{
		function index (){
			$data ['judul_content'] = 'Dashboard';
			$data ['isi_content']	= 'dashboard_index';
			$this->load->view('default', $data);
		}
	}