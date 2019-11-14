<?php
    
    class Inventaris_model extends CI_Model {

        function showAll(){
            $sql = "
            SELECT 
                inventaris.id_inventaris,
                inventaris.nama, 
                inventaris.kode_inventaris,
                inventaris.jumlah, 
                inventaris.kondisi,
                ruang.nama_ruang, 
                jenis.nama_jenis 
            FROM inventaris 
            JOIN jenis ON inventaris.id_jenis = jenis.id_jenis 
            JOIN ruang ON inventaris.id_ruang = ruang.id_ruang
            ";

            $result = $this->db->query($sql);
            return $result;
        }

        function dropdownJenis(){
            $query = $this->db->get('jenis');
            $data = [];
            foreach ($query->result() as $row){
                $data[$row->id_jenis]= $row->nama_jenis;
            }
            return $data;
        }

        function dropdownRuang(){
            $query = $this->db->get('ruang');
            $data = [];
            foreach ($query->result() as $row){
                $data[$row->id_ruang]= $row->nama_ruang;
            }
            return $data;
        }

        function kodeJenis($id_jenis){
            $this->db->where("id_jenis", $id_jenis);
            $result = $this->db->get("jenis");
            return $result->row()->kode_jenis;
        }
    
        function kodeRuang($id_ruang){
            $this->db->where("id_ruang", $id_ruang);
            $result = $this->db->get("ruang");
            return $result->row()->kode_ruang;
        }

        function lastId() {
            $query = $this->db->query("
              SELECT * FROM inventaris ORDER BY id_inventaris DESC LIMIT 1;
            ");
            /** get last id from inventaris */
            $row = $query->row(1);
            /** return for setting id to 'kode_inventaris' */
            return $row->id_inventaris+1;
        }

        function checkId($id_inventaris){
            $result = $this->db->query("
            SELECT * FROM inventaris WHERE id_inventaris = '".$id_inventaris."';
            ");
            return $result;
        }

        function getInventaris($id){
            $this->db->where("id_inventaris", $id);
            $result = $this->db->get("inventaris");
            return $result->row_array();
        }
    }
?>