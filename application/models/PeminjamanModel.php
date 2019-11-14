<?php
    class PeminjamanModel extends CI_Model {

        function showAll() {
            $sql = "
            SELECT 
                inventaris.id_inventaris,
                inventaris.nama, 
                inventaris.jumlah, 
                ruang.nama_ruang, 
                jenis.nama_jenis 
            FROM inventaris 
            JOIN jenis ON inventaris.id_jenis = jenis.id_jenis 
            JOIN ruang ON inventaris.id_ruang = ruang.id_ruang
            ";

            $result = $this->db->query($sql);
            return $result;
        }
    }
?>