<?php

Class Auth extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('AuthData');
  }

  function index() {

    if (isset($_POST['login']) && $_POST != '') {
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');
      if ($this->form_validation->run() == TRUE) {
        if (count($this->AuthData->checkLogin($_POST['email'], $_POST['password'])) == 1) {
         
          $email = $_POST['email']; 
           $this->session->set_flashdata('email', $email);
          // $userid = $this->Account_model->get_userid($email);

          $sess_array = array('UserID' => $this->AuthData->checkLogin($_POST['email'], $_POST['password']));
          $this->session->set_userdata('logged_in', $sess_array);
          redirect(base_url() . "index.php/Accounts/index", 'refresh');
        } else
          echo 'login error';
      }
    }
    $data['pageContent'] = '      <div class="row">';
    $data['pageContent'] .= '        <div class="col-sm-2">';
    $data['pageContent'] .= '         <form action="' . base_url() . 'index.php/auth/index" method="POST">';
    $data['pageContent'] .= '           <div class=form-group">';
    $data['pageContent'] .= '             <label>Email</label>';
    $data['pageContent'] .= '             <input type="text" name="email" class="form-control">';
    $data['pageContent'] .= '           </div>';
    $data['pageContent'] .= '           <div class=form-group">';
    $data['pageContent'] .= '             <label>Password</label>';
    $data['pageContent'] .= '             <input type="password" name="password" class="form-control">';
    $data['pageContent'] .= '           </div>';
    $data['pageContent'] .= '           <br />';
    $data['pageContent'] .= '           <div class=form-group">';
    $data['pageContent'] .= '             <input class="form-control btn-success" name="login" value="Log me in!" type="submit">';
    $data['pageContent'] .= '           </div>';
    $data['pageContent'] .= '         </form>';
    $data['pageContent'] .= '      </div>';
    $data['pageContent'] .= '    </div>';

     $this->load->view('users/index', $data);
  }

  function create() {
    if (isset($_POST['login']) && $_POST['login'] != '') {
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');
      $this->form_validation->set_rules('firstname', 'FirstName', 'trim|required');
      $this->form_validation->set_rules('lastname', 'LastName', 'trim|required');
      if ($this->form_validation->run() == TRUE) {
        $this->AuthData->createUser($_POST);
      }
    }

    $data['pageContent'] = '      <div class="row">';
    $data['pageContent'] .= '        <div class="col-sm-2">';
    $data['pageContent'] .= validation_errors();
    $data['pageContent'] .= '         <form action="' . base_url() . 'index.php/auth/create/index" method="POST">';
    $data['pageContent'] .= '           <div class=form-group">';
    $data['pageContent'] .= '             <label>Email</label>';
    $data['pageContent'] .= '             <input type="text" name="email" class="form-control">';
    $data['pageContent'] .= '           </div>';
    $data['pageContent'] .= '           <div class=form-group">';
    $data['pageContent'] .= '             <label>Password</label>';
    $data['pageContent'] .= '             <input type="password" name="password" class="form-control">';
    $data['pageContent'] .= '           </div>';
    $data['pageContent'] .= '           <div class=form-group">';
    $data['pageContent'] .= '             <label>First Name</label>';
    $data['pageContent'] .= '             <input type="text" name="firstname" class="form-control">';
    $data['pageContent'] .= '           </div>';
    $data['pageContent'] .= '           <div class=form-group">';
    $data['pageContent'] .= '             <label>Last Name</label>';
    $data['pageContent'] .= '             <input type="text" name="lastname" class="form-control">';
    $data['pageContent'] .= '           </div>';
    $data['pageContent'] .= '           <br />';
    $data['pageContent'] .= '           <div class=form-group">';
    $data['pageContent'] .= '             <input class="form-control btn-success" name="login" value="Create Acount" type="submit">';
    $data['pageContent'] .= '           </div>';
    $data['pageContent'] .= '         </form>';
    $data['pageContent'] .= '      </div>';
    $data['pageContent'] .= '    </div>';

    $this->load->view('users/index', $data);
  }


}
