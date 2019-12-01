<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    function __construct() {
		parent::__construct();
        $this->load->model('Product_model');
        if(!$this->session->userdata('logged_in')){
            redirect(base_url().'index.php/Login');

        }

      }
      



    public function index(){
        if(isset($_POST['buy']) && isset($_POST['quantity']) && !empty($_POST['quantity'] )){
            $price = $_POST['ItemPrice'];
            $qt = $_POST['quantity'];
            $total = $price*$qt;
            echo '<div class="alert alert-primary text-center " id="success-alert" role="alert">
            Your order was placed and your total was $'.$total.'
          </div>';
        $this->Product_model->storeOrder($_POST['OrderID'],$_POST['UserID'],$total, $_POST['OrderDate'],$_POST['quantity'],$_POST['ItemName'], $_POST['ItemDescription'],$_POST['ItemPrice']);
        }
        else if(isset($_POST['buy'])&& empty($_POST['quantity'] )) {
            echo "Please enter quantity";
        }

        $data['pageContent'] = '
        <div class="container-fluid navigationbar">
<div class="row ">

<div class="col-md-5">
        <div class="d-flex justify-content-between">
            <ul class="">
            
            </ul>
</div>
</div>
<div class="col-md-2 d-flex justify-content-center">
            <div >
                <img src="'.base_url().'assets/tag.png" width="45px" height="45px">
           </div>
</div>
<div class="col-md-5 d-flex d-flex justify-content-end ">
            <ul class="">
            <li class="text-right">
                    <a class="nav-link" href="'.base_url().'index.php/Accounts/index">'. $this->session->userdata()["email"].' </a>
                </li>
                <li class="nav-item align-self-end">
                    <a class="nav-link" href="'.base_url().'index.php/login/logout">Logout</a>
                </li>

            </ul>
    </div>
       
</div>
</div>


<div class="row searchContainer">
    <div class="col-md-3">
    </div>
    <div class="col-md-6 d-flex justify-content-center">
    
        <form method="POST" action="'.base_url().'index.php/Products/index">
        <div class="row">
        <div class="col d-flex justify-content-between">

        <label for="searchbox">Search </label>
        <input class="form-control" type="text" name="searchbox">
        </div>
        <div class="col d-flex justify-content-between">

        <label for="categorysearch">Category </label>
        <select class="form-control" name="categorysearch">
            <option value="" selected disabled>Select a Category</option>
            <option value="Electronics">Electronics</option>
            <option value="Clothes">Clothes</option>
            <option value="Furniture">Furniture</option>
        </select>
        </div>
        </div>
        <div class="searchbutton">
        <button  class="btn btn-success" name="search">Update</button>
        </div>
        </form>
        
    </div>
    <div class="col-md-3">
    </div>
</div>


<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10 productsContainer">';


     
    
    
if(isset($_POST['searchbox']) && !empty($_POST['searchbox']) && isset($_POST['search'])){
    
    foreach($this->Product_model->getSearchedProduct($_POST['searchbox']) as $rows){
        $data['pageContent'] .=  "
        <div class='card text-center' style='width: 18rem;'>
        <div class='card-body'>
        <h5 class='card-title'>".$rows->ItemName."</h5>
        <p class='card-text'>".$rows->ItemDescription."</p>


        <button type='button' class='btn btn-primary modalTrigger' data-toggle='modal'";
        $data['pageContent'] .=  'data-details=\'{"ItemName":"'.$rows->ItemName.'","ItemPrice":'.$rows->ItemPrice.',"ItemID":'.$rows->ItemID.',"ItemDescription":"'.$rows->ItemDescription.'"}\' data-target="#staticBackdrop">';
        $data['pageContent'] .=  "
       Buy at $".$rows->ItemPrice."
        </button>

        <div class='modal fade' id='staticBackdrop' data-backdrop='static' tabindex='-1' role='dialog' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='title' id='staticBackdropLabel'></h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      
      <div class='modal-body'>
      <form method='POST' action='".base_url()."index.php/Products/index'>
      <input type='number' min='1' placeholder='Select Quantity' name='quantity'>
      
      <input  type='hidden' id='itemID'name='ItemID' value='".$rows->ItemID."' >
      <input  type='hidden' name='UserID' value='".$this->session->userdata('logged_in')["UserID"]."' >
      <input type='hidden' id='itemPrice' name='ItemPrice' value='' class='btn btn-primary' > 
      <input type='hidden' id='itemName' name='ItemName' value='' class='btn btn-primary' >
      <input type='hidden' id='itemDescription' name='ItemDescription' value='' class='btn btn-primary' >
      <input type='hidden' name='OrderID' value='".rand()."' class='btn btn-primary' >
      <input type='hidden' name='OrderDate' value='".date("Y-m-d")."' class='btn btn-primary' >
     
      <button type='submit' name='buy' class='btn btn-primary' >Buy Now</button>
      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button> 
      </form>

      </div>
      
        
    </div>
  </div>
  
</div>
</div>

     </div>";

    }
    
}
else if(isset($_POST['categorysearch']) && !empty($_POST['categorysearch']) && isset($_POST['search'])){
    
    foreach($this->Product_model->getProductsbyCategory($_POST['categorysearch'] ) as $rows){
        $data['pageContent'] .=  "
        <div class='card text-center' style='width: 18rem;'>
        <div class='card-body'>
        <h5 class='card-title'>".$rows->ItemName."</h5>
        <p class='card-text'>".$rows->ItemDescription."</p>


        <button type='button' class='btn btn-primary modalTrigger' data-toggle='modal'";
        $data['pageContent'] .=  'data-details=\'{"ItemName":"'.$rows->ItemName.'","ItemPrice":'.$rows->ItemPrice.',"ItemID":'.$rows->ItemID.',"ItemDescription":"'.$rows->ItemDescription.'"}\' data-target="#staticBackdrop">';
        $data['pageContent'] .=  "
       Buy at $".$rows->ItemPrice."
        </button>

        <div class='modal fade' id='staticBackdrop' data-backdrop='static' tabindex='-1' role='dialog' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='title' id='staticBackdropLabel'></h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      
      <div class='modal-body'>
      <form method='POST' action='".base_url()."index.php/Products/index'>
      <input type='number' min='1' placeholder='Select Quantity' name='quantity'>
      
      <input  type='hidden' id='itemID'name='ItemID' value='".$rows->ItemID."' >
      <input  type='hidden' name='UserID' value='".$this->session->userdata('logged_in')["UserID"]."' >
      <input type='hidden' id='itemPrice' name='ItemPrice' value='' class='btn btn-primary' > 
      <input type='hidden' id='itemName' name='ItemName' value='' class='btn btn-primary' >
      <input type='hidden' id='itemDescription' name='ItemDescription' value='' class='btn btn-primary' >
      <input type='hidden' name='OrderID' value='".rand()."' class='btn btn-primary' >
      <input type='hidden' name='OrderDate' value='".date("Y-m-d")."' class='btn btn-primary' >
     
      <button type='submit' name='buy' class='btn btn-primary' >Buy Now</button>
      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button> 
      </form>

      </div>
      
        
    </div>
  </div>
  
</div>
</div>

     </div>";

    }
    
}
else if(empty($_POST['searchbox'])){
    
    foreach($this->Product_model->getAllProducts() as $rows){
         
        
        
        $data['pageContent'] .=  "
        <div class='card text-center' style='width: 18rem;'>
        <div class='card-body'>
        <h5 class='card-title'>".$rows->ItemName."</h5>
        <p class='card-text'>".$rows->ItemDescription."</p>


        <button type='button' class='btn btn-primary modalTrigger' data-toggle='modal'";
        $data['pageContent'] .=  'data-details=\'{"ItemName":"'.$rows->ItemName.'","ItemPrice":'.$rows->ItemPrice.',"ItemID":'.$rows->ItemID.',"ItemDescription":"'.$rows->ItemDescription.'"}\' data-target="#staticBackdrop">';
        $data['pageContent'] .=  "
       Buy at $".$rows->ItemPrice."
        </button>

        <div class='modal fade' id='staticBackdrop' data-backdrop='static' tabindex='-1' role='dialog' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='title' id='staticBackdropLabel'></h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      
      <div class='modal-body'>
      <form method='POST' action='".base_url()."index.php/Products/index'>
      <input type='number'  min='1' placeholder='Select Quantity' name='quantity'>
      
      <input  type='hidden' id='itemID'name='ItemID' value='".$rows->ItemID."' >
      <input  type='hidden' name='UserID' value='".$this->session->userdata('logged_in')["UserID"]."' >
      <input type='hidden' id='itemPrice' name='ItemPrice' value='' class='btn btn-primary' > 
      <input type='hidden' id='itemName' name='ItemName' value='' class='btn btn-primary' >
      <input type='hidden' id='itemDescription' name='ItemDescription' value='' class='btn btn-primary' >
      <input type='hidden' name='OrderID' value='".rand()."' class='btn btn-primary' >
      <input type='hidden' name='OrderDate' value='".date("Y-m-d")."' class='btn btn-primary' >
     
      <button type='submit' name='buy' class='btn btn-primary' >Buy Now</button>
      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button> 
      </form>

      </div>
      
        
    </div>
  </div>
  
</div>
</div>

     </div>";

    }
}

$data['pageContent'] .= '
</div>
    <div class="col-md-1">
    </div>
</div>
<script type="text/javascript">
setTimeout(function(){
    $("#success-alert").remove();
  }, 9000);
  $(document).on("click", ".modalTrigger", function () {
    var itemName = $(this).data("details").ItemName;
    var itemPrice = $(this).data("details").ItemPrice;
    var itemID = $(this).data("details").ItemID;
    var itemDescription = $(this).data("details").ItemDescription;

    $(".modal-body #itemName").val( itemName );
    $(".modal-body #itemPrice").val( itemPrice );
    $(".modal-body #itemID").val( itemID );
    $(".modal-body #itemDescription").val( itemDescription);
    $(".modal-header #title").text(itemName);
});

  
</script>
';
        
        $this->load->view('products_page', $data);
   
}
}