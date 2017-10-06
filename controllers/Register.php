<?php

class Register extends CI_Controller {
	function index(){
		$this->load->view('partials/header');
		$this->load->view('register');
		$this->load->view('partials/footer');
	}

	function register_submit(){
		$username = $this->input->post('username');
		$pw = $this->input->post('pw');
		$cpw = $this->input->post('cpw');
		if($cpw!="" && $pw!="" && $username!=""){
			if($pw!=$cpw){
				echo "The passwords must match!";
			}else{
				$this->load->model('user');
				if(count($this->user->ReadByUsername($username))<1){
					if($this->user->Create($username,$pw)>0){
						echo "Successfully added user $username";
						echo "<br>Click <a href='../Login'>here</a> to login";
					}
				}else{
					echo "Username $username already exists"; 			
				}
			}	
		}else{
			echo "You must fill in all fields";
		}
		
	}
}