<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('Account_model');
      }
      



    public function index(){

    $email = $this->session->flashdata('email');
      
    $this->session->keep_flashdata('email', $email);

      $email = $this->session->flashdata('email');
      $userid = $this->Account_model->get_userid($email);
      $data['pageContent'] = '<h4>User Profile</h4>
      <div class="container">
          <div class="row">
              <div class="col-sm-2 ">
                  <table class="table">
                      <tbody>
                          <tr>
                              <th scope="col"><a href="http://165.227.250.8/~hescalante/WebProg/index.php/Accounts/index?userid='.$userid.'&email='.$email.'&userInfo=1">User Info</a></th>
                          </tr>
                          <tr>
                              <th scope="row"><a href="http://165.227.250.8/~hescalante/WebProg/index.php/Accounts/index?userid='.$userid.'&email='.$email.'&pastOrders=1">Past Orders</a></th>
                          </tr>
                      </tbody>
                  </table>
              </div>
              <div class="col-sm-2 ">
  </div>
              <div class="col-sm-8">';
             if(isset($_GET['userInfo'])){
  $data['pageContent'] .= '<h5>User Info</h5>
              <table class="table">
                      <tbody>
                          <tr>
                              <th scope="col">
                              <form>
                          <div class="form-group">
                              <label for="name">Full Name</label>
                              <input type="text" class="form-control" id="name" value='.$this->Account_model->get_username($email).'>
                          </div>
  
                              </th>
                              <th scope="col">
                              <div class="form-group">
                              <label for="email">E-mail</label>
                              <input type="text" class="form-control" id="email" value='.$email.'>
                          </div>
                           </th>
                              
                          </tr>
  
                      </form>
  
                      
                      </tbody>
                  </table>';
    $data['pageContent'] .= '        <button type="button" class="btn btn-success">Success</button>';
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
      </div>';
   




        $this->load->view('accounts/index', $data);
     }

}