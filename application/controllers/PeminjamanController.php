<?php
    class PeminjamanController extends CI_Controller {

        function __construct() {
            parent:: __construct();

            $this->load->model("PeminjamanModel");
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


        function index() {
            $data["data"] = $this->PeminjamanModel->showAll();
            $data["judul_content"] = "Daftar Peminjaman";
            $data["isi_content"] = "PeminjamanIndexView";

            $this->load->view("default", $data);
        }

        function add() {
            $data["judul_content"] = "Tambah Data Peminjaman";
            $data["isi_content"] = "PeminjamanAddView";

            $data["inventaris"] = $this->PeminjamanModel->dropdownInvent();

            $this->load->view("default", $data);
        }

        function addExecute() {
            $this->load->model("PeminjamanModel");
            $submit = $this->input->post("submitInvent");
            $idInvent = $this->input->post("idInvent");
            $jumlahPinjam = $this->input->post("jumlah");
            $jumlahBarang = $this->PeminjamanModel->getAmount($idInvent);
            $sisa = $jumlahBarang - $jumlahPinjam;

            $forDetail = $this->PeminjamanModel->getId();

            if (isset($submit)) {
                $data = [
                    "id_peminjaman" => NULL,
                    "tanggal_pinjam" => date("Y-m-d H:i:s"),
                    "tanggal_kembali" => NULL,
                    "status_peminjaman" => "dipinjam",
                    "id_pegawai" => NULL
                ];

                $detailData = [
                    "id_detail_pinjam" =>NULL,
                    "id_inventaris" => $idInvent,
                    "id_peminjaman" => $forDetail,
                    "jumlah" => $jumlahPinjam
                ];

                $dataUpdate = [
                    "jumlah" => $sisa
                ];

                $insert = $this->db->insert("peminjaman", $data);
                $insert = $this->db->insert("detail_pinjam", $detailData);

                /** update inventaris amount */
                $this->db->where("id_inventaris", $idInvent);
                $update = $this->db->update("inventaris", $dataUpdate);

                if ($this->db->affected_rows() > 0) {
                    echo '
                            <script>
                                alert("Data Berhasil Ditambahkan");
                                window.location = "'.base_url('index.php/PeminjamanController').'";
                            </script>
                        ';
                } else {
                    echo '
                            <script>
                                alert("Data Berhasil Ditambahkan");
                                window.location = "'.base_url('index.php/PeminjamanController').'";
                            </script>
                        ';
                }
            } else {
                show_404();
            }
        }

        function getBack($id_detail_pinjam) {
            $this->load->model("PeminjamanModel");
            $jumlahBarang = $this->PeminjamanModel->getAmount($id_detail_pinjam);
            $jumlahPinjam = $this->PeminjamanModel->getBorrow($id_detail_pinjam);
            
            $sumResult = $jumlahBarang+$jumlahPinjam;

            $dataInvent = [
                "jumlah" => $sumResult
            ];

            $status  = [
                "status_peminjaman" => "dikembalikan"
            ];

            /** update inventaris amount */
            $this->db->where("id_inventaris", $idInvent);
            $update = $this->db->update("inventaris", $dataInvent);

            $this->db->where("id_peminjaman", $idBorr);
            $update = $this->db->update("peminjaman", $status);

        }
    }

?>