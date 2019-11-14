<?php
	class jenis_model extends CI_Model {

		function showAll (){
			$result = $this->db->query("
					SELECT * FROM jenis ORDER BY
					id_jenis DESC;
				");
			return $result;
		}

		function cekkode($id) {
			$result = $this->db->query("
				SELECT * FROM jenis WHERE kode_jenis = '".$kode."';

			");
			return $result;
		}

		function check_ID($id_jenis) {
			$result =$this->db->query("
				SELECT * FROM jenis WHERE id_jenis = '". $id_jenis ."';
				");
				return $result;
		}
	
	}
?>