<?php

Class OrderData extends CI_Model {
  
  

  function getPastOrders() {
     $query = $this->db->query("select OrderID, UserID, OrderTotal, ItemOrderedName, ItemOrderedDescription, OrderDate from Final_Orders where UserId = 1 ");
    
    return $query->result();
  }


}
