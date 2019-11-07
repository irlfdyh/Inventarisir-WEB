<?php

    class ruang extends CI_Controller{

        function __construct(){
            parent::__construct();
            $this->load->model('ruang_model');
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

        function index(){
            $data['judul_content'] = 'JENIS_RUANG';
            $data['isi_content'] = 'ruang_index';
            $data['data'] = $this->ruang_model->showAll();

            $this->load->view('default', $data);
        }

        function add(){
            $data['judul_content'] = "TAMBAH RUANGAN";
            $data['isi_content'] = "ruang_add";

            $this->load->view('default', $data);
        }

        public function addExecute(){

            $submit = $this->input->post("submit_ruang");
            $kode_ruang = $this->input->post("kode_ruang");
            $nama_ruang = $this->input->post("nama_ruang");
            $keterangan = $this->input->post("keterangan");

            if(isset($submit)){

                $check = $this->ruang_model->cekKode($kode_ruang);

                if ($check->num_rows() == 0){
                    $data = [
                        "id_ruang" => null,
                        "kode_ruang" => $kode_ruang,
                        "nama_ruang" => $nama_ruang,
                        "keterangan" => $keterangan
                    ];
                    $this->db->insert("ruang", $data);

                    if ($this->db->affected_rows() > 0){
                        echo '
                        <script>
                            alert("Data Ruang Berhasil Ditambahkan");
                            window.location = "'.base_url('index.php/ruang').'";
                        </script>
                        ';
                    } else {
                        echo '
                        <script>
                            alert("Data Ruang Gagal Ditambahkan");
                            window.location = "'.base_url('ruang/add').'";
                        </script>
                        ';
                    }
                } else {
                    echo '
                        <script>
                            alert("Data Ruang Sudah ada");
                            window.location = "'.base_url('index.php/ruang/add').'";
                        </script>
                        ';
                }


            } else {
                show_404();
            }
        }

        public function edit($id_ruang) {
            $check = $this->ruang_model->cekID($id_ruang);
    
            if($check->num_rows() > 0){
                $data["row"] = $check->row_array();
                $data["judul_content"] = "Edit Ruangan";
                $data["isi_content"] = "ruang_edit"; 
    
                $this->load->view('default', $data);
            } else {
                show_404();
            }
        }

        public function editExecute(){
            $submit = $this->input->post("submit_ruang");
            $id_ruang = $this->input->post("id_ruang");
            $kode_ruang = $this->input->post("kode_ruang");
            $nama_ruang = $this->input->post("nama_ruang");
            $keterangan = $this->input->post("keterangan");

            if (isset($submit)){
                $check = $this->db->query(
                    "SELECT * FROM ruang WHERE kode_ruang = '".$kode_ruang."'"
                );

                if ($check->num_rows() == 0){
                    show_404();
                } else {
                    $data = [
                        "nama_ruang" => $nama_ruang,
                        "keterangan" => $keterangan
                    ];

                    $this->db->where("kode_ruang", $kode_ruang);
                    $update = $this->db->update("ruang", $data);

                    if ($this->db->affected_rows() > 0){
                        echo '
						<script>
							alert("Data Jenis Berhasil Diubah");
							window.location = "'.base_url('index.php/ruang').'";
						</script>
						';
                    } else {
                        echo '
						<script>
							alert("Data Jenis Gagal Diubah");
							window.location = "'.base_url('index.php/ruang/edit/'.$_jenis).'";
						</script>
						';
                    }
                }
            } else {
                show_404();
            }
        }

        public function hapus($id_ruang) {

            $check = $this->db->query(
                "SELECT * FROM ruang WHERE id_ruang = '".$id_ruang."'"
            );

            if ($check->num_rows() > 0) {
                $this->db->where("id_ruang", $id_ruang);
                $result = $this->db->delete("ruang");

                if ($result) {
                    echo 
					'<script>
						alert("data berhasil dI hapus  !");
						window.location = "'.site_url('ruang').'";
					</script>';
                } else {
                    echo 
					'<script>
						alert ("data gagal di hapus  !")
						window.localotion = "'.site_url('ruang').'"		
					</script>';
                }

            } else {
                show_404();
            }
        }
    }
?>