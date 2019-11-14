<?php
	class jenis extends CI_Controller {
		function __construct() {
			parent::__construct();

			$this->load->model('jenis_model');
			$this->load->model("LoginModel");
			$this->load->library("session");
			
			/** check are user is logged in */
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
			$data['judul_content'] = 'Daftar Jenis Barang';
			$data['isi_content']	= 'jenis_index';
			$data['data'] = $this->jenis_model->ShowAll();

			$this->load->view('default', $data);
		}

		function add() {
			$data['judul_content'] = "TAMBAH JENIS BARANG";
			$data['isi_content'] = "jenis_add";

			$this->load->view('default', $data);
		}

		public function add_execute() {
			$submit = $this->input->post("submit_jenis");
			$kode_jenis = $this->input->post("kode_jenis");
			$nama_jenis = $this->input->post("nama_jenis");
			$keterangan = $this->input->post("keterangan");

			if (isset($submit)) {
				$data = [
					"id_jenis" => null,
					"kode_jenis" => $kode_jenis,
					"nama_jenis" => $nama_jenis,
					"keterangan" => $keterangan
				];
				$this->db->insert("jenis", $data);

				if ($this->db->affected_rows() > 0) {
					echo '
						<script>
							alert("Data Jenis Berhasil Ditambahkan");
							window.location = "'.base_url('index.php/jenis').'";
						</script>
					';
				} else {
					echo '
						<script>
							alert("Data Jenis Gagal Ditambahkan");
							window.location = "'.base_url('jenis/add').'";
						</script>
					';
				}
			} else {
				show_404();
			}
		}

		public function edit($id_jenis) {
			$check = $this->jenis_model->check_ID($id_jenis);

			if ($check->num_rows() > 0) {
				$data["row"] = $check->row_array();
				$data["judul_content"] = "Edit Jenis";
				$data["isi_content"] = "jenis_edit"; 

				$this->load->view('default', $data);
			} else {
				show_404();
			}
		}

		public function edit_execute() {
			$submit = $this->input->post("submit_jenis");
			$id_jenis = $this->input->post("id_jenis");
			$kode_jenis = $this->input->post("kode_jenis");
			$nama_jenis = $this->input->post("nama_jenis");
			$keterangan = $this->input->post("keterangan");
			
			if (isset($submit)) {
				$check = $this->db->query("
					SELECT * FROM jenis WHERE kode_jenis = '". $kode_jenis ."';
				");

				if ($check->num_rows()==0) {
					show_404();
				} else {
					// buat kedalam array
					$data = [
						"nama_jenis" => $nama_jenis,
						"keterangan" => $keterangan
					];

					// query builder
					$this->db->where("kode_jenis", $kode_jenis);
					$update = $this->db->update("jenis", $data);

					// cek apakah data tsb ada atau tidak
					if ($this->db->affected_rows()>0) {
						echo '
							<script>
								alert("Data Jenis Berhasil Diubah");
								window.location = "'.base_url('index.php/jenis').'";
							</script>
							';
					} else {
						echo '
							<script>
								alert("Data Jenis Gagal Diubah");
								window.location = "'.base_url('index.php/jenis/edit/'.$_jenis).'";
							</script>
							';
					}
				}
			} else {
				show_404();
			}
		}

		function hapus($id_jenis) {

			$check = $this->db->query("
			SELECT * FROM jenis WHERE id_jenis = '".$id_jenis ."'");
				
				if ($check->num_rows() > 0) {
					$this->db->where("id_jenis", $id_jenis);
					$result = $this->db->delete("jenis");
					
					if ($result) {
						echo 
						'<script>
							alert("data berhasil dI hapus  !");
							window.location = "'.site_url('jenis').'";
						</script>';

					} else {
						echo 
						'<script>
							alert ("data gagal di hapus  !")
							window.localotion = "'.site_url('jenis').'"		
						</script>';
					}	
					
				} else {
					show_404();
				}
		}
}
