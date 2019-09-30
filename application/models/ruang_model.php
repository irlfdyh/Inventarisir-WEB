<?php

    class jenis_model extends CI_Model{

        /**
         * Model untuk koneksi dari databse
         */

        function showAll(){
            $result = $this->db->query(
                "SELECT * FROM ruang ORDER BY id_ruang DESC;"
            );
            return $result;
        }

        function cekKode($id){
            $result = $this->db->query(
                "SELECT * FROM ruang WHERE kode_ruang = '".$kode."';"
            );
            return $result;
        }

        function checkID($id_ruang){
            $result = $this->db->query(
                "SELECT * FROM ruang where id_ruang = '".$id_ruang."';"
            );
        }

    }
?>