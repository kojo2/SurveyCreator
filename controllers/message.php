<?php

class Message extends CI_Controller {
	function index($message){
		$this->load->view('partials/header');
		$this->load->view('partials/message',array('message'=>$message));
		$this->load->view('partials/footer');
	}
}