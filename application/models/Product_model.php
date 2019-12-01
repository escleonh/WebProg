<?php

Class Product_model extends CI_Model {
    public function getAllProducts(){
    
        $query = $this->db->query("select ItemID, ItemName, ItemDescription, ItemPrice from Final_All_Items");
       
        return $query->result();
      }
      public function getSearchedProduct($product){
        // echo "select ItemID, ItemName, ItemDescription, ItemPrice from Final_All_Items where ItemName='$product'";
        $query = $this->db->query("select ItemID, ItemName, ItemDescription, ItemPrice from Final_All_Items where ItemName='$product'");
       
        return $query->result();
      }
      public function getProductbyID($id){
        // echo "select ItemID, ItemName, ItemDescription, ItemPrice from Final_All_Items where ItemName='$product'";
        $query = $this->db->query("select ItemID, ItemName, ItemDescription, ItemPrice from Final_All_Items where ItemID=$id");
       
        return $query->result();
      }
      public function getProductsbyCategory( $category){
        // echo "select ItemID, ItemName, ItemDescription, ItemPrice from Final_All_Items where ItemName='$product'";
        $query = $this->db->query("select ItemID, ItemName, ItemDescription, ItemPrice from Final_All_Items where ItemCategory='$category'");
       
        return $query->result();
      }
      public function storeOrder($OrderID, $UserID, $OrderTotal, $OrderDate, $ItemOrdered, $ItemOrderedName, $ItemOrderedDescription, $ItemOrderedPrice){
        $query = $this->db->query("insert into Final_Orders values($OrderID, $UserID, $OrderTotal, '$OrderDate', $ItemOrdered, '$ItemOrderedName', '$ItemOrderedDescription', $ItemOrderedPrice)");
       
        if($this->db->affected_rows()==1) 
            return true;
        else
            return false;
}
      }


   