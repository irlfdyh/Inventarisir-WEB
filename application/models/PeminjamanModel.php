<?php
    class PeminjamanModel extends CI_Model {

        function showAll() {
            $sql = "
                SELECT 
                    peminjaman.id_peminjaman, 
                    peminjaman.tanggal_pinjam, 
                    peminjaman.status_peminjaman,
                    detail_pinjam.id_detail_pinjam, 
                    detail_pinjam.id_inventaris, 
                    detail_pinjam.jumlah, 
                    inventaris.nama 
                FROM detail_pinjam 
                JOIN peminjaman ON detail_pinjam.id_peminjaman = peminjaman.id_peminjaman 
                JOIN inventaris ON detail_pinjam.id_inventaris = inventaris.id_inventaris
                WHERE peminjaman.status_peminjaman = 'dipinjam'    
            ";

            $result = $this->db->query($sql);
            return $result;
        }

        function dropdownInvent() {
            $query = $this->db->get("inventaris");
            $data = [];

            foreach ($query->result() as $row) {
                $data[$row->id_inventaris] = $row->nama;
            }

            return $data;
        }

        /** get amount count */
        function getAmount($idInvent) {
            $this->db->where("id_inventaris", $idInvent);
            $result = $this->db->get("inventaris");
            
            return $result->row()->jumlah;
        }

        /** get borrow count */
        function getBorrow($idBorr) {
            $this->db->where("id_detail_pinjam", $idBorr);
            $result = $this->db->get("detail_pinjam");

            return $result->row()->jumlah;
        }

        function getInventId($idPeminjaman) {
            $this->db->where("id_peminjaman", $idPeminjaman);
            $result = $this->db->get("detail_pinjam");

            return $result->row()->id_inventaris;
        }

        function showBack() {
            $sql = "
                SELECT 
                    peminjaman.id_peminjaman, 
                    peminjaman.tanggal_pinjam, 
                    peminjaman.tanggal_kembali,
                    peminjaman.status_peminjaman, 
                    detail_pinjam.id_inventaris, 
                    detail_pinjam.jumlah, 
                    inventaris.nama 
                FROM detail_pinjam 
                JOIN peminjaman ON detail_pinjam.id_peminjaman = peminjaman.id_peminjaman 
                JOIN inventaris ON detail_pinjam.id_inventaris = inventaris.id_inventaris
                WHERE peminjaman.status_peminjaman = 'dikembalikan'    
            ";

            $result = $this->db->query($sql);
            return $result;
        }

        function getId() {
            $query = $this->db->get("inventaris");

            if ($query->result() != null) {
                    $sql = $this->db->query("
                        SELECT * FROM peminjaman ORDER BY id_peminjaman DESC LIMIT 1;
                    ");

                $row = $sql->row(1);
                return $row->id_peminjaman+1;
            } else {
                1;
            }
        }

    }
?>