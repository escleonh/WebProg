<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('OrderData');
	  }


	public function index()
	{
	
		// $data['pageContent'] = '<a href="#">View Orders</a>';
		$data['pageContent'] = '<a href="http://165.227.250.8/~hescalante/WebProg/index.php/Welcome?userid=1">View Order</a>';
		 
		
		foreach($this->OrderData->getPastOrders() as $row){
			$data['pageContent'] .= '<h5>' . $row->OrderID. '</h5>';
			$data['pageContent'] .= '<h5>' . $row->UserID. '</h5>';
			$data['pageContent'] .= '<h5>' . $row->OrderTotal. '</h5>';
			$data['pageContent'] .= '<h5>' . $row->OrderDate. '</h5>';
			$data['pageContent'] .= '<h5>' . $row->ItemOrderedDescription. '</h5>';
			$data['pageContent'] .= '<h5>' . $row->ItemOrderedName. '</h5>';
			$data['pageContent'] .= '*****************************';
		 }


		$this->load->view('welcome_message', $data);
	}
}
