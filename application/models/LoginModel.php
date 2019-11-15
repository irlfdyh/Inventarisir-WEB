<?php
    class LoginModel extends CI_Model {

        function checkAccount($username, $password) {
            $this->db->where("username", $username);
            $resUsername = $this->db->get("petugas");

            $this->db->where("password", $password);
            $resPassword = $this->db->get("petugas");

            if ($resUsername->num_rows() == 0 && $resPassword->num_rows() == 0) {
                return 'not found';
            } 
            if ($resUsername->num_rows() == 0) {
                return 'wrong username';
            }
            if ($resPassword->num_rows() == 0) {
                return 'wrong password';
            }

            $result = $this->db->get('petugas');
            return $result;
        }
        
    }
?>