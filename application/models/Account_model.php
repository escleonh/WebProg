<?php

Class Account_model extends CI_Model {
   
  
  public function get_orderHistory($userid){
    
    $query = $this->db->query("select OrderID, UserID, OrderTotal, ItemOrderedName, ItemOrderedDescription, OrderDate from Final_Orders where UserID =".$userid);
   
    return $query->result();
  }



  
  public function get_username($email){
    $query = $this->db->query(" select FullName from Final_Users where Email='".$email."' ");
    
    $res = $query->result();
   
    return $res[0]->FullName;
  }
  public function get_userid($email){
    $query = $this->db->query(" select UserID from Final_Users where Email='".$email."' ");
    
    $res = $query->result();
   
    return $res[0]->UserID;
  }
  function changeEmail($id, $email) {
        //  echo $id.' '.$email;
        //  echo "update Final_Users set Email='".$email."' where UserID = $id.";
    $query = $this->db->query("update Final_Users set Email='$email' where UserID=$id");

    if($this->db->affected_rows() ==1) 
        return true;
    else
        return false;
}

  function changeFullName($id, $name) {
    $query = $this->db->query("update Final_Users set FullName='$name' where UserID=$id");

  if($this->db->affected_rows()==1) 
    return true;
  else
    return false;
  }


  function deleteAccount($userid) {
    echo ("delete from Final_Users where UserID = $userid");
    $query = $this->db->query("delete from Final_Users where UserID=$userid");

  if($this->db->affected_rows()==1) 
    return true;
  else
    return false;
  }
}
