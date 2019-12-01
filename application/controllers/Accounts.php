<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {
    function __construct() {
		parent::__construct();
    $this->load->model('Account_model');
    if(!$this->session->userdata('logged_in')){
      redirect(base_url().'index.php/Login');

  }
      }
      



    public function index(){
      $email =  $this->session->userdata()["email"];
      
       $userid = $this->Account_model->get_userid($email);

      if(isset($_POST['update'])&& isset($_POST['email'])){
        if($this->Account_model->changeEmail($userid, $_POST['email'])== true){
          $this->session->set_userdata('email', $_POST['email']);
          $email = $this->session->userdata()["email"];
         }
        
      }
      if(isset($_POST['update'])&& isset($_POST['name'])){
        if($this->Account_model->changeFullName($userid, $_POST['name'])== true){
          
         }

      }
      if(isset($_POST['delete'])){
        if($this->Account_model->deleteAccount($userid)== true){
          redirect(base_url().'index.php/Login');
         }

      }
      // $userid = $this->Account_model->get_userid($email);

     

  $data['pageContent'] = ' 
  <div class="mainContainer">
  <div class="container-fluid navigationbar align-middle">
  <div class="row ">
  
  <div class="col-md-5">
          <div class="d-flex justify-content-between">
              <ul class="">
              <a class="nav-link" href="'.base_url().'index.php/Products/index">Shop </a>

              </ul>
  </div>
  </div>
  <div class="col-md-2 d-flex justify-content-center">
              <div >
                  <img src="'.base_url().'assets/tag.png" width="45px" height="45px">
             </div>
  </div>
  <div class="col-md-5 d-flex justify-content-end ">
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
  <div style=""; margin-top:40px" class="container ">

      <div class="container">
          <div class="row">
              <div class="col-sm-2 ">
                  <table class="table">
                      <tbody>
                          <tr>
                              <th style="" scope="col"><a href="'.base_url().'index.php/Accounts/index?userInfo=1"><img style="margin-right:8px"src="'.base_url().'assets/person-outline.png" width="20px" height="20px">User Info</a></th>
                          </tr>
                          <tr>
                              <th style="border-bottom: 1px solid #dee2e6" scope="row"><a href="'.base_url().'index.php/Accounts/index?pastOrders=1"><img style="margin-right:8px" src="'.base_url().'assets/orders.png" width="20px" height="20px">Past Orders</a></th>
                          </tr>
                      </tbody>
                  </table>
              </div>
              <div class="col-sm-1 ">
  </div>
              <div class="col-sm-8" ">';
             if(isset($_GET['userInfo'])){
  $data['pageContent'] .= '
  <div  style="margin:0 auto; background:url('.base_url().'assets/profile-image-png-8.png);background-size:cover;background-position:center;border:1px solid black; margin-bottom:30px; width:100px; height:100px; border-radius:50px"></div>

    <h5 style=" text-align:center" >User Info</h5>
              <table class="table">
                      <tbody>
                          <tr >
                              <th scope="col">
                              <form method="POST" action="http://165.227.250.8/~hescalante/WebProg/index.php/Accounts/index?userInfo=1">
                          
                                <div class="form-group">
                              <label for="name">Full Name</label>
                              <input type="text" class="form-control" name="name" id="name" value='.$this->Account_model->get_username($email).'>
                          </div>
  
                              </th>

                              <th scope="col">
                              <div class="form-group">
                              <label for="email">E-mail</label>
                              <input type="text" class="form-control" id="email" name="email" value='.$email.'>
                          </div>
                          
                           </tr>
                              
                          <tr style=" text-align:center">
                          <td colspan="2" style="outline:none"; >
                          <button style="border-radius:55px" type="submit" class="btn btn-danger" name="update">Update</button></br></br>
                          <button style="border-radius:55px" type="submit" class="btn btn-danger" name="delete">Delete Account</button>

                          </td>
                          </tr>
  
                      </form>
  
                      
                      </tbody>
                  </table>';
    // $data['pageContent'] .= '        <button type="button" class="btn btn-success">Success</button>';
             }
            else if(isset($_GET['pastOrders'])){
              $data['pageContent'] .= '<h5>Order History Info</h5>
              <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Oorder ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Order Total</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Item Description</th>
                        <th scope="col">Item Name</th>
                      </tr>
                    </thead>
                    <tbody>';

                  foreach($this->Account_model->get_orderHistory($userid) as $row){

                    $data['pageContent'] .= '
                    <tr>
                    <td>'.$row->OrderID.'</td>
                    <td>'.$row->UserID.'</td>
                    <td>'.$row->OrderTotal.'</td>
                    <td>'.$row->OrderDate.'</td>
                    <td>'.$row->ItemOrderedDescription.'</td>
                    <td>'.$row->ItemOrderedName.'</td>
                    </tr>';
                  }
                    $data['pageContent'] .= '  </tbody>
              </table>';
            }
             $data['pageContent'] .= '         </div>
          </div>
      </div>
      </div>
      </div>';
    




        $this->load->view('accounts/index', $data);
     }
     

}