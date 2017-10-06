<?php
/**
* 
*/
class answerView extends CI_model
{
	
	function getTemplateForTypeId($typeId){
		// this is where the types of questions are set

		switch($typeId){
			case 1:
				$template = 'yesNo';
				break;
			case 2:
				$template = 'mc';
				break;
			case 3:
				$template = 'sada';
				break;
			case 4:
				$template = 'input';
				break;
		}

		return $template;
	}
}