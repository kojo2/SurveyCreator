<?php

/**
* 
*/
class Questions extends CI_Controller
{
	


	function ChooseSector($sector){
		if(!$this->session->userdata('respondentId')){
			redirect('/');
		}
		
		//here we want to load the questions for this particular sector
		$this->load->model('question');
		$this->load->model('sector');
		//first we need to check the sector table to find out what id this sector has, then we feed that id to the question table
		$sectorR = $this->sector->FindSectorByName($sector)[0];
		$results = $this->question->ReadAllForSector($sectorR->id);

		

		//loop through resulting questions and add their id's to an array for putting into a session variable

		$sessionQuestions = array();

		foreach ($results as $r) {
			array_push($sessionQuestions, $r->id);
		}


		// shove the array into the session 
		$this->session->set_userdata('questionIds',$sessionQuestions);

		// start the question count at the first question and shove that into the session

		$currentQuestionId = 0;

		$this->session->set_userdata('currentQuestionId',$currentQuestionId);

		// store the sector id into the session as well as we'll probably want it later

		$this->session->set_userdata('sectorId',$sector);

		// and the sector name as well (just for convenience)

		$this->session->set_userdata('sectorName',$sectorR);

		// session data holds the numbers of questions that are coming up in an array, and the current question number.
		// then we call GetNextQuestion using ajax from the main question template view to bring up the next question.

		$currentQuestionId = $this->session->userdata('currentQuestionId');
		// load the questionsMaster template view
		$this->load->view('partials/header');
		$this->load->view('questionsMaster',$this->session->userdata);
		$this->load->view('partials/footer');

		
		/*really what we want to do here is open a master template with holes in it for poking questions through in a subview based on what type id the current question has. so we need to pass all of the question data (typeid etc) to the view, not just the body of the question.

		so you'd have a subview for multiple choice, a subview for YN, a subview for text input and a subview for SADA questions*/

	}

	function GetNextQuestion(){
		// get the next question by the question id
		$currentQuestionId = $this->session->userdata('currentQuestionId');

		// get the question that is linked to this id

		$this->load->model('question');

		
		$ids = $this->session->userdata('questionIds');
		if(isset($ids[$currentQuestionId])){
			$question = $this->question->ReadQuestionById($ids[$currentQuestionId]);
			echo json_encode($question);
			$id = $ids[$currentQuestionId];
		}else{
			echo "end";
		}
	}

	function GetAnswerTemplate(){
		$currentQuestionId = $this->session->userdata('currentQuestionId');
		$this->load->model('question');

		$question = $this->question->ReadQuestionById($this->session->userdata('questionIds')[$currentQuestionId]);
		$this->load->model('answerView');
		$answerTemplate = $this->answerView->getTemplateForTypeId($question[0]->typeId);

		if($answerTemplate!='mc'){
			$this->IncreaseCount();
		}

		$this->load->view('templates/'.$answerTemplate,$this->session->userdata);
		

		

	}

	function GetmAnswers(){
		$this->load->model('mAnswers');
		$questionId = $this->session->userdata('questionIds')[$this->session->userdata('currentQuestionId')];
		$results = $this->mAnswers->ReadAllForQuestionId($questionId);
		$this->IncreaseCount();
		echo json_encode($results);
		

	}

	function IncreaseCount(){
		$currentQuestionId = $this->session->userdata('currentQuestionId');
		$currentQuestionId+=1;
		$this->session->set_userdata('currentQuestionId',$currentQuestionId);
	}

	function PostAnswer($questionId){
		$choice = $this->input->post('choice');
		$this->load->model('answers');
		$respondentId = $this->session->userdata('respondentId');
		if($this->answers->Create($questionId,$respondentId,$choice)){
			//continue to next question (in view via ajax)
			echo "Saved";
		}else{
			echo "Something went wrong, please try again.";
		}
	}
}