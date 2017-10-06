<?php

class Home extends CI_Controller {
	function index(){
		if($this->session->userdata('username')!=null){
			$params = array('username'=>$this->session->userdata('username'));
			if($this->session->userdata('admin')){
				redirect('admin');
			}else{
				$this->load->view('partials/header');
				$this->load->view('staffHome',$params);
				$this->load->view('partials/header');
			}
		}else{
			redirect('/');	
		}
		
	}
}