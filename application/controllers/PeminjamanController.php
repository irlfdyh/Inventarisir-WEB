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
                if ($jumlahBarang < $jumlahPinjam) {
                    echo '
                                <script>
                                    alert("Jumlah barang tidak mencukupi");
                                    window.location = "'.base_url('index.php/PeminjamanController/add').'";
                                </script>
                        ';
                } else if ($jumlahPinjam == 0) {
                    echo '
                                <script>
                                    alert("Kamu Tidak Pinjam apa apa");
                                    window.location = "'.base_url('index.php/PeminjamanController/add').'";
                                </script>
                        ';
                } else {
                    $data = [
                        "id_peminjaman" => NULL,
                        "tanggal_pinjam" => date("Y-m-d H:i:s"),
                        "tanggal_kembali" => NULL,
                        "status_peminjaman" => "dipinjam",
                        "id_pegawai" => $this->session->userdata()->namespace
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
                                    alert("Data Gagal Ditaagmbahkan");
                                    window.location = "'.base_url('index.php/PeminjamanController').'";
                                </script>
                            ';
                    }
                }
            } else {
                show_404();
            }
        }

        function getBack($id_peminjaman) {
            $this->load->model("PeminjamanModel");

            $getInventId = $this->PeminjamanModel->getInventId($id_peminjaman);
            $jumlahBarang = $this->PeminjamanModel->getAmount($getInventId);
            $jumlahPinjam = $this->PeminjamanModel->getBorrow($id_peminjaman);
            
            $sumResult = $jumlahBarang+$jumlahPinjam;

            $dataInvent = [
                "jumlah" => $sumResult
            ];

            $status  = [
                "tanggal_kembali" => date("Y-m-d H:i:s"),
                "status_peminjaman" => "dikembalikan"
            ];

            /** update inventaris amount */
            $this->db->where("id_inventaris", $getInventId);
            $update = $this->db->update("inventaris", $dataInvent);

            $this->db->where("id_peminjaman", $id_peminjaman);
            $update = $this->db->update("peminjaman", $status);

            /** check  */
            if ($this->db->affected_rows() > 0) {
                echo '
                        <script>
                            alert("Data Berhasil Dikembalikan");
                            window.location = "'.base_url('index.php/PeminjamanController').'";
                        </script>
                    ';
            } else {
                echo '
                        <script>
                            alert("Data Gagal Dikembalikan");
                            window.location = "'.base_url('index.php/PeminjamanController').'";
                        </script>
                    ';
            }

        }
    }

?>