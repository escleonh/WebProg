<?php

Class AuthData extends CI_Model {

  function setPasswordHash($password) {
    return hash('SHA512', 'PokJlgSftLzzDfaeJxqHhKUirsBTIA988KgEatI3TiTDH4R9DivsAYFCms985Y5' . $password);
  }

  function checkLogin($email, $password) {
    $query = $this->db->query("select UserID
                                 from Final_Users
                                where Email = '" . $email . "'
                                  and Password = '" . $this->setPasswordHash($password) . "'");
    $res = $query->result();
    return $res[0]->UserID;
  }
  function createUser($data) {
    $users = array(
        'Email' => $data['email'],
        'Password' => $this->setPasswordHash($data['password']),
        // 'users_status' => 'A',
        'FullName' => $data['firstname'],
        // 'users_lastname' => $data['lastname']
    );
    $this->db->insert('Final_Users', $users);
  }
 

}
