<?php

class AuthData extends CI_Model {
    function setPasswordHash($password) {
        return Hash('SHA512', 'adcJxJilCLyGKny7aSMKgDxjZVVyQG3UpGUvIsxyiuo22jt4NFhSAGBTzyE3vQh' . $password);
    }
    
    function checkLogin($email, $password) {
        //$query = $this->db->query("select users_id from users where users_email = '".$email."' and users_password = '".$this->setPasswordHash($password)."'");
        $query = $this->db->query("select UserID, FullName from Final_Users where Email = '".$email."' and Password = '".$this->setPasswordHash($password)."'");
        $res = $query->result();
        return $res[0]->UserID;
        //return $query->result();
    }
    
    function createUser($data) {
        $users = array(
            'Email' => $data['email'],
            'Password' => $this->setPasswordHash($data['password']),
            'FullName' => $data['fullname'],
        );
        $this->db->insert('Final_Users', $users);
        
    }
    
}

