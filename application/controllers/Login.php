<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author nmohamed
 */
class Login  extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('AuthData');
    }
    
    function index(){
        if (isset($_POST['Login']) && $_POST['Login'] != "") {
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
        
        if (isset($_POST['Create']) && $_POST['Create'] != '') {
            //echo 'got here';
            redirect(base_url() . 'index.php/login/create', 'refresh');
        }
            
        $data['pageContent'] = '      <div class="row">';
        $data['pageContent'] .= '        <div class="col-sm-10">';
        $data['pageContent'] .= '        <h4>Login to start</h4>';
        $data['pageContent'] .= '        <p>If you dont have an account. You can create one for free</p>';
        $data['pageContent'] .= '        <div class="row">';
        $data['pageContent'] .= '        <div class="col-sm-3">';
        //$data['pageContent'] .=  '<form action="index.php" method="get">';
        $data['pageContent'] .= '         <form action="' . base_url() . 'index.php/login" method="POST">';
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <label>Email</label>';
        $data['pageContent'] .= '          <input type="text" name="email" class="form-control">';
        $data['pageContent'] .= '           </div>';
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <label>Password</label>';
        $data['pageContent'] .= '          <input type="password" name="password" class="form-control">';
        $data['pageContent'] .= '           </div>';
        $data['pageContent'] .= '           <br />';
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <input class="form-control btn-success" name="Login" value="Log in" type="submit">';
        $data['pageContent'] .= '           <br />';
        $data['pageContent'] .= '           <input class="form-control btn-success" name="Create" value="User Sign-up" type="submit">';
        $data['pageContent'] .= '           </div>';
        $data['pageContent'] .= '         </form>';
        $data['pageContent'] .= '      </div>';
        $this->load->view('users/LoginPage', $data);
    }
    
    
    function create() {
        if (isset($_POST['Login']) && $_POST['Login'] != '') {
            //echo 'got here';
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('fullname', 'FullName', 'trim|required');
            //$this->form_validation->set_rules('lastname', 'LastName', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $this->AuthData->createUser($_POST);
                echo 'Account Created';
                redirect(base_url() . 'index.php/login', 'refresh');
            }
        }

        $data['pageContent'] = '      <div class="row">';
        $data['pageContent'] .= '        <div class="col-sm-2">';
        $data['pageContent'] .= '        <h4>User Sign up</h4>';
        $data['pageContent'] .= validation_errors();
        $data['pageContent'] .= '         <form action="' . base_url() . 'index.php/login/create" method="POST">';
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <label>Email</label>';
        $data['pageContent'] .= '          <input type="text" name="email" class="form-control">';
        $data['pageContent'] .= '           </div>';
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <label>Password</label>';
        $data['pageContent'] .= '          <input type="password" name="password" class="form-control">';
        $data['pageContent'] .= '           </div>';
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <label>Full Name</label>';
        $data['pageContent'] .= '          <input type="text" name="fullname" class="form-control">';
        $data['pageContent'] .= '           </div>';
//        $data['pageContent'] .= '           <div class=form-group">';
//        $data['pageContent'] .= '             <label>Last Name</label>';
//        $data['pageContent'] .= '          <input type="text" name="lastname" class="form-control">';
//        $data['pageContent'] .= '           </div>';
        $data['pageContent'] .= '           <br />';
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <input class="form-control btn-success" name="Login" value="Create Account" type="submit">';
        $data['pageContent'] .= '           </div>';
        $data['pageContent'] .= '         </form>';
        $data['pageContent'] .= '      </div>';
        
        //redirect(base_url() . 'index.php/login', 'refresh');

        $this->load->view('users/LoginPage', $data);
       

    }
    //redirect(base_url() . 'index.php/login/create', 'refresh');
}
