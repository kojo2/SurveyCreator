<?php

class StartSurvey extends CI_Controller
{
	
	function index(){
		/*if(!$this->session->userdata('respondentId')){
			redirect('/');
		}*/
		$this->load->model('sector');
		$params = array();
		$sectors = $this->sector->ReadAll();
		$params['sectors']=$sectors;
		$this->load->view('partials/header');
		$this->load->view('sectorChoice',$params);
		$this->load->view('partials/footer');
	}

}