<?php

class Details extends Ci_Controller {
	function index(){
		$this->load->view('partials/header');
		$this->load->view('templates/details');
		$this->load->view('partials/footer');
	}

	function CreateRespondent(){
		$this->session->unset_userdata('respondentId');
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$organisation = $this->input->post('organisation');
		$email = $this->input->post('email');
		$tel = $this->input->post('tel');
		$address = $this->input->post('address');
		$postcode = $this->input->post('postcode');
		$error = "";

		if(strlen($fname)==0){
			$error = "Please enter a first name";
		}
		if(strlen($fname)>0 && strlen($fname)<3){
			$error .= "Firstname too short<br>";
		}
		if(count($fname)>50){
			$error .= "Firstname too long<br>";
		}

		if(strlen($lname)==0){
			$error = "Please enter a last name";
		}
		if(strlen($lname)>0 && strlen($lname)<3){
			$error .= "Lastname too short<br>";
		}
		if(count($lname)>50){
			$error .= "Lastname too long<br>";
		}

		if(strlen($organisation)==0){
			$error = "Please enter an organisation";
		}
		if(strlen($organisation)>0 && strlen($organisation)<2){
			$error .= "Organisation too short<br>";
		}
		if(strlen($organisation)>250){
			$error .= "Organisation too long<br>";
		}
		if($error){
			echo $error;
		}else{
			$this->load->model('respondent');
			$result = $this->respondent->Create($fname,$lname,$organisation,$email,$tel,$address,$postcode);
			if($result){
				$id = $this->respondent->ReadByFnameLname($fname,$lname)[0]->id;
				$this->session->set_userdata('respondentId',$id);
				echo("<script>window.location.href='".base_url()."index.php/startSurvey';</script>");
			}else{
				echo "there was a problem creating respondent";
			}
		}
	}
}

?>