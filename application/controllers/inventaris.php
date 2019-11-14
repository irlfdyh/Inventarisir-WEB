<?php

    class inventaris extends CI_Controller{

        function __construct(){
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

        function alert($alert, $alert_type, $url=NULL) {
            $this->load->model('inventaris_model');
            $this->load->set_userdata('alert_error', $alert);
            $this->load->set_userdata('alert_error_type', $alert_type);

            if (!empty($url)) {
                redirect($url);
            }
        }

        function index(){
            $data["data"] = $this->inventaris_model->showAll();
            $data["judul_content"] = "Daftar Inventaris";
            $data["isi_content"] = "inventaris_index";

            $this->load->view("default", $data);
        }
        
        function add(){
            $data["judul_content"] = "tambah data inventaris";
            $data["isi_content"] = "inventaris_add";

            $data["jenis"] = $this->inventaris_model->dropdownjenis();
            $data["ruang"] = $this->inventaris_model->dropdownruang();

            $this->load->view("default", $data);
        }

        function add_execute(){
            $this->load->model('inventaris_model');
			$submit = $this->input->post("submit_inventaris");
			$nama = $this->input->post("nama");
			$kondisi = $this->input->post("kondisi");
			$keterangan = $this->input->post("keterangan");
			$jumlah = $this->input->post("jumlah");
			
			$jenis = $this->input->post("id_jenis");
			$ruang = $this->input->post("id_ruang");
			
			if( isset($submit) ) {
				$kode_jenis = $this->inventaris_model->kodeJenis($jenis);
				$kode_ruang = $this->inventaris_model->kodeRuang($ruang);
				$last_id = $this->inventaris_model->lastId();
				
				$kode_inventaris = 
					date("ymd")."-".$kode_jenis."-".$kode_ruang."-".$last_id."";
				
				$data = [
                    "id_inventaris" => NULL,
                    "nama" => $nama,
                    "kondisi" => $kondisi,
                    "keterangan" => $keterangan,
					"jumlah" => $jumlah,
					"id_jenis" => $jenis,
					"id_ruang" => $ruang,
					"tanggal_register" => date("Y-m-d H:i:s"),
					"kode_inventaris" => $kode_inventaris,
					"id_petugas" => NULL
                ];
				
                $insert = $this->db->insert("inventaris", $data);

                if( $this->db->affected_rows() > 0 ) {
                    echo '
                            <script>
                                alert("Data Berhasil Ditambahkan");
                                window.location = "'.base_url('index.php/inventaris').'";
                            </script>
                        ';
                }else {
                    echo '
                            <script>
                                alert("Data Gagal Ditambahkan");
                                window.location = "'.base_url('index.php/inventaris').'";
                            </script>
                        ';
                }
			}else{
				show_404();
			}
        }
        
        function edit($id) {
            $this->load->model('inventaris_model');
            $data["judul_content"] = "Edit Data Inventaris";
			$data["isi_content"] = "inventaris_edit";
			
			$data["result"] = $this->inventaris_model->getInventaris($id);
			
			$data["jenis"] = $this->inventaris_model->dropdownJenis();
			$data["ruang"] = $this->inventaris_model->dropdownRuang();
			
			$this->load->view("default", $data);
        }

        function editExecute() {
            $this->load->model('inventaris_model');
			$submit = $this->input->post("submit_inventaris");
			$nama = $this->input->post("nama");
			$kondisi = $this->input->post("kondisi");
			$keterangan = $this->input->post("keterangan");
			$jumlah = $this->input->post("jumlah");
			
			$id_inventaris = $this->input->post("id_inventaris");
			
			$jenis = $this->input->post("id_jenis");
            $ruang = $this->input->post("id_ruang");
            
            if( isset($submit) ) {
				$kode_jenis = $this->inventaris_model->kodeJenis($jenis);
				$kode_ruang = $this->inventaris_model->kodeRuang($ruang);
				$last_id = $this->inventaris_model->lastId();
				
				$kode_inventaris = 
					date("ymd")."-".$kode_jenis."-".$kode_ruang."-".$last_id;
				
				$data = [
                    "nama" => $nama,
                    "kondisi" => $kondisi,
                    "keterangan" => $keterangan,
					"jumlah" => $jumlah,
					"id_jenis" => $jenis,
					"id_ruang" => $ruang,
					"tanggal_register" => date("Y-m-d H:i:s"),
					"kode_inventaris" => $kode_inventaris,
					"id_petugas" => NULL
                ];
				$this->db->where("id_inventaris", $id_inventaris);
                $update = $this->db->update("inventaris", $data);

                if( $this->db->affected_rows() > 0 ) {
                    echo '
                        <script>
                            alert("Data Berhasil Diubah");
                            window.location = "'.base_url('index.php/inventaris').'";
                        </script>
                        ';
                }else {
                    echo '
                        <script>
                            alert("Data Gagal Diubah");
                            window.location = "'.base_url('index.php/inventaris').'";
                        </script>
                        ';
                }
			}else{
				show_404();
			}
        }

        function hapus($id_inventaris) {
            $check = $this->db->query("
                SELECT * FROM inventaris WHERE id_inventaris = '".$id_inventaris."'
            ");

            if($check->num_rows() > 0) {
                $this->db->where("id_inventaris", $id_inventaris);
                $result = $this->db->delete("inventaris");

                if($result) {
                    echo '
                        <script>
                            alert("Data Inventaris Berhasil Dihapus");
                            window.location = "'.base_url('index.php/inventaris').'";
                        </script>
                        ';
                } else {
                    echo '
                        <script>
                            alert("Data Inventaris Gagal Dihapus");
                            window.location = "'.base_url('index.php/inventaris').'";
                        </script>
                        ';
                }
            } else {
                show_404();
            }
        }
    }

?>