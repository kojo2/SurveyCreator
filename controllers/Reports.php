<?php

class Reports extends Ci_Controller {
	function index() {
		if(!$this->CheckAdmin()){
			redirect('/');
		}
		$this->load->view('partials/header');
		$this->load->view('viewReports');
		$this->load->view('partials/footer');
	}

	function ViewResponses(){
		if(!$this->CheckAdmin()){
			redirect('/');
		}
		$this->load->model('answers');
		$answers = array();
		/*$respondents = $this->answers->GetRespondents();
		foreach ($respondents as $respondent) {
			array_push($answers,$this->answers->ReadJoinQuestionsByRespondentId($respondent));	
		}*/
		$answers = $this->answers->ReadJoinQuestionsOnRespondents();
		$this->load->view('partials/header');
		$this->load->view('reports/responses',array('answers'=>$answers));
		$this->load->view('partials/footer');
	}

	function ViewQuestionPercentages() {
		if(!$this->CheckAdmin()){
			redirect('/');
		}
		$this->load->view('partials/header');
		$this->load->view('reports/questionPercentages');
		$this->load->view('partials/footer');
	}

	function CheckAdmin(){
		if($this->session->userdata('admin')){
			return true;
		}else{
			return false;
		}
	}

}