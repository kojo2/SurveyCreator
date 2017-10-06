<?php

class Login extends CI_Controller {
	function index(){
		$this->load->view('partials/header');
		$this->load->view('login');
		$this->load->view('partials/footer');
	}

	function login_submit(){
		//$username = $this->input->post('username');
		$username = $_POST['username'];
		$password= $this->input->post('pw');
		$this->load->model('user');
		$user = $this->user->ReadUser($username,$password);
		if(count($user)>0){
			$this->session->set_userdata('username',$username);
			if($user[0]->admin){
				$this->session->set_userdata('admin',true);
			}else{
				$this->session->set_userdata('admin',false);
			}
			redirect('Home');
		}else{
			echo "could not find user";
		}
	}
}