<?php

namespace App\Http\Controllers\Admin\Schools;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\User as User;
use App\Models\School;
use App\Models\SchoolBoard;
use App\Models\Survey as Record;
use App\Models\SurveyQuestion as Question;

class SurveysController extends AdminController {

	protected $view_path = 'schools.surveys';

	protected $base_url = '/admin/s/surveys';

	public function __construct()
	{
		$this->access('system:manage_schools');

		\View::share(['nav_level1' => 'schools.surveys', 'nav_level2' => 'schools.surveys']);
	}

	public function getIndex()
	{
		$list = Record::getListable()->paginate(20);

		//$this->sorting( Record::$sorting );

		return \View::make("admin.$this->view_path.list")->with('records', $list);
	}

	public function getAdd()
	{
		return \View::make("admin.$this->view_path.form");
	}

	public function getInfo($id)
	{
		$record = Record::where('id',$id)->first();

		return \View::make("admin.$this->view_path.form")->with('record',$record);
	}

	public function postAdd(Request $request)
	{
		$record = new Record;

		$this->validate($request, [
			'title'	 => 'required',
	    ]);

		$record->fill(\Input::all())->save();

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url($this->base_url) ]);
	}

	public function getQuestions($id)
	{
		$record = Record::where('id',$id)->first();

		$list = $record->getQuestions();
		$list->title = $record->title;
		$list->survey_id = $id;

		return \View::make("admin.$this->view_path.sections.questions")->with('record', $list);
	}

	public function getInfoQuestion($id)
	{
		
		$question = Question::where('id',$id)->first();
		$record = Record::where('id',$question->survey_id)->first();
		$question->title = $record->title;
		
		return \View::make("admin.$this->view_path.sections.addquestion")->with('record', $question);

	}

	public function getAddQuestion($id)
	{	
		$record = Record::where('id',$id)->first();
		$record->survey_id  = $record->id;
		return \View::make("admin.$this->view_path.sections.addquestion")->with('record',$record);
	}

	public function postAddQuestion(Request $request,$id)
	{
		$this->validate($request, [
			'question' => 'required'
	    ]);

		$record = Record::where('id',$id)->first();		
		$count = $record->count_questions;
		$count++;

		$question = array(
			'survey_id' => $id,
			'num'		=> $count,
			'question'	=> \Input::get('question'));

		$recordQuestion = new Question;

		$recordQuestion->fill($question)->save();

		$record->count_questions = $count;
		$record->save();

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url($this->base_url.'/questions/'.$id) ]);
	}

	public function postRemoveQuestion($id)
	{
		$question = Question::where('id',$id)->first();
		$survey_id = $question->survey_id;

		$survey = Record::where('id',$survey_id)->first();

		if($question->delete()){
			$survey->count_questions = $survey->count_questions-1;
			$survey->save();

			return \Response::json(['result' => true, 'msg' => trans('crud.success_added')]);
		}
		else{
			return \Response::json(['result' => false, 'msg' => trans('crud.failed_added')]);
		}
	}
}