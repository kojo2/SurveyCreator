<?php 

class End extends Ci_Controller {
	function index(){
		$this->session->sess_destroy;
		$this->load->view('partials/header');
		$this->load->view('end');
		$this->load->view('partials/footer');
	}
}