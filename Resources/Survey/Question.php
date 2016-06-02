<?php
namespace SurveyGizmo\Resources\Survey;

use SurveyGizmo\ApiResource;
use SurveyGizmo\Helpers\SurveyGizmoException;

/**
 * Class for Survey Question API objects
 * Question is a sub-object of Surveys
 */
class Question extends ApiResource {

	/**
	 * API call path 
	 */
	static $path = "/survey/{survey_id}/surveyquestion/{id}";

	/**
	 * Fetch list of SurveyGizmo Question Objects by survey id
	 * @access public
	 * @param int $survey_id - Survey ID
	 * @param SurveyGizmo\Filter $filters - filter object
	 * @param Array $options
	 * @return SurveyGizmo\ApiResponse Object with SurveyGizmo\Question Objects
	 */
	public static function fetch($survey_id, $filters = null, $options = null) {
		if ($survey_id < 1) {
			throw new SurveyGizmoException(500, "Missing survey ID");
		}
		$response = self::_fetch(array('id' => '', 'survey_id' => $survey_id), $filter, $options);
		return $response;
	}

	/**
	 * Get Question Obj by survey id and question id
	 * @access public
	 * @param int $survey_id - survey id
	 * @param int $id - question id
	 * @return SurveyGizmo\Question Object
	 */
	public static function get($survey_id, $id){
		if ($id < 1 && $survey_id < 1) {
			throw new SurveyGizmoException(500, "IDs required");
		}
		return self::_get(array(
			'survey_id' => $survey_id,
			'id' => $id,
		));
	}

	/**
	 * Save current Question Obj
	 * @access public
	 * @return SurveyGizmo\ApiResponse Object with SurveyGizmo\Question Object
	 */
	public function save(){
		return $this->_save(array(
			'survey_id' => $this->survey_id,
			'id' => $this->exists() ? $this->id : ''
		));
	}

	/**
	 * Delete current Question Obj
	 * @access public
	 * @return SurveyGizmo\ApiResponse Object
	 */
	public function delete(){
		return self::_delete(array(
			'survey_id' => $survey_id,
			'id' => $this->id,
		));
	}

	/**
	 * Get current Question Option Obj by id
	 * @access public
	 * @param Int $id option ID
	 * @return SurveyGizmo\Resource\QuestionOption Object
	 */
	public function getOption($id){
		foreach ($this->options as $key => $option) {
			if($option->id == $id){
				return $option;
			}
		}
	}
}
?>