<?php
    class LoginModel extends CI_Model {

        function checkAccount($username, $password) {
            $this->db->where("username", $username);
            $this->db->where("password", $password);
            $result = $this->db->get("petugas");

            return $result;
        }
        
    }
?>