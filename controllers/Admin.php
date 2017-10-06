<?php


/**
* 
*/
class Admin extends CI_Controller
{
	
	function index(){
		if(!$this->CheckAdmin()){
			redirect('/');
		}
			$params = array('username'=>$this->session->userdata('username'));
			$this->load->view('partials/header');
			$this->load->view('adminHome',$params);
			$this->load->view('partials/footer');
	}

	function CheckAdmin(){
		if($this->session->userdata('admin')){
			return true;
		}else{
			return false;
		}
	}

	function EditQuestions(){
		if(!$this->CheckAdmin()){
			redirect('/');
		}
		$this->load->model('question');
		$results = $this->question->ReadAllJoin();
		$params = array('questions'=>$results);
		$this->load->view('partials/header');
		$this->load->view('adminEditQuestions',$params);
		$this->load->view('partials/footer');
	}

	function EditQuestion($questionId){
		if(!$this->CheckAdmin()){
			redirect('/');
		}
		$this->load->model('question');
		$results = $this->question->ReadQuestionByIdJoinSector($questionId)[0];
		//print_r($results);
		$params = array('questionId'=>$questionId,'question'=>$results->question,'sector'=>$results->name,'sectorIds'=>$results->sectorIds,'type'=>$results->typeId);

		$this->load->view('partials/header');
		$this->load->view('adminTemplates/editQuestion',$params);
		$this->load->view('partials/footer');
	}

	function AddNewQuestion(){
		if(!$this->CheckAdmin()){
			redirect('/');
		}
		$this->load->view('partials/header');
		$this->load->view('adminTemplates/newQuestion');
		$this->load->view('partials/footer');
	}

	function AddNewMCQuestion(){
		if(!$this->CheckAdmin()){
			redirect('/');
		}
		$this->load->view('partials/header');
		$this->load->view('adminTemplates/newMCQuestion');
		$this->load->view('partials/footer');
	}

	function CreateNewQuestion(){
		if(!$this->CheckAdmin()){
			redirect('/');
		}
		$question = $this->security->xss_clean(ucfirst($this->input->post('question',true)));
		$sectors = $this->input->post('sectors');
		$type = $this->input->post('type');
		$this->load->model('question');
		$result = $this->question->Create($question,$sectors,$type);
		if($result){
			echo "entered into the database successfully";
		}else{
			echo "there was a problem entering that into the database";
		}
	}

	function CreateNewMCQuestion(){
		if(!$this->CheckAdmin()){
			redirect('/');
		}
		$totalAnswers = $this->input->post('idsTotal');
		$contentsOfPost = $this->input->post();
		// take off the last element of the array which will always be the idsTotal
		array_pop($contentsOfPost);
		$question = $contentsOfPost['question'];
		$questions = array_slice($contentsOfPost,2);
		$sectorIds = $contentsOfPost['sectorIds'];
		$this->load->model('question');
		$result = $this->question->Create($question,$sectorIds,"Multiple Choice");
		if($result){
			// we have entered the question into the database so now we shall query it to get the id it was put under so we can feed it to the mAnswers table
			$questionInDatabase = $this->question->ReadByQuestion($question)[0];
			$qid = $questionInDatabase->id;
			$this->load->model('mAnswers');
			foreach ($questions as $q) {
				$resultMa = $this->mAnswers->Create($qid,$q);
				if(!$resultMa){
					echo "There was a problem entering this mAnswer";
				}
			}
			echo "Successfully entered all answers into the database";
			echo "<script>setInterval(function(){window.location.href='".base_url()."index.php/Admin'},3000);</script>";
		}else{
			echo "there was a problem entering this question into the database";
		}
	}

	function DeleteQuestion($questionId){
		if(!$this->CheckAdmin()){
			redirect('/');
		}
		$this->load->model('question');
		$result = $this->question->Delete($questionId);
		if($result){
			echo "successfully deleted!";
		}else{
			echo "there was a problem deleting that question";
		}
	}

	function SyncData(){
		$this->load->view('partials/header');
		$this->load->model('answers');
		$answers = array();
		$answers = $this->answers->ReadJoinQuestionsOnRespondents();
		$this->load->model('device');
		$keyCode = $this->device->Read()[0]->keyCode;
		$this->load->view('adminTemplates/sync',array('answers'=>$answers,'key'=>$keyCode));
		$this->load->view('partials/footer');

	}

	function RegisterDevice(){
		$this->load->view('partials/header');
		$this->load->view('registerDevice');
		$this->load->view('partials/footer');
	}

	function RegisterDeviceWithCode($code){
		$this->load->model('device');
		$result = $this->device->Create($code);
		if($result){
			echo "device registered successfully!!";
			echo "<script>setInterval(function(){window.location.href='".base_url()."index.php/Admin'},3000);</script>";
		}else{
			echo "There was a problem changing the registed device key";
		}
	}

	function Delete(){
		//clears all survey respondents and answers from the device (to be used after syncing)
		$this->load->model('respondent');
		$this->load->model('answers');
		$deletedRespondent = $this->respondent->Delete();
		$deletedAnswers = $this->answers->Delete();
		if($deletedAnswers && $deletedRespondent){
			echo "successfully cleared the device";
			echo "<script>setInterval(function(){window.location.href='".base_url()."index.php/Admin'},3000);</script>";
		}else{
			echo "couldn't wipe the device";
		}
	}

}