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
}