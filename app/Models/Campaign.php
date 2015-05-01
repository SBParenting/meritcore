<?php namespace App\Models;

use \App\Models\CampaignStudent;
use \App\Models\CampaignStat;
use \App\Models\SurveyGrouping;
use \App\Models\SurveyQuestion;

class Campaign extends \App\Models\Model {

	protected $table = 'campaigns';

	protected $fillable = ['school_id', 'class_id', 'title', 'survey_id', 'count_total', 'count_started', 'count_completed', 'started_progress', 'completed_progress', 'status'];

	public static $sortable = ['title', 'status', 'start_date', 'end_date', 'count_total', 'count_start', 'count_completed'];

	public static $defaultSort = ['name', 'asc'];

	public function survey()
	{
		return $this->belongsTo('App\Models\Survey');
	}

	public function school()
	{
		return $this->belongsTo('App\Models\School');
	}

	public function classroom()
	{
		return $this->belongsTo('App\Models\Classroom', 'class_id');
	}

	public function students()
	{
		return $this->hasMany('App\Models\CampaignStudent', 'campaign_id');
	}

	public function stats()
	{
		return $this->hasMany('App\Models\CampaignStat', 'campaign_id');
	}

	public static function getListable($var=false)
    {
        $query   = static::initListable($var);
       
        $filters = static::initStatic($var);

        $sort = self::getSort();

        if (!empty($sort->sort) && in_array($sort->sort, self::$sortable))
        {
	        switch($sort->sort)
	        {
	            default:
	                $query->orderBy($sort->sort, $sort->order);
	        }
        }

        return $query;
    }

	public function updateRecord()
	{
		$this->count_total = CampaignStudent::where('campaign_id', '=', $this->id)->count();
		$this->count_started = CampaignStudent::where('campaign_id', '=', $this->id)
			->where(function ($sql) {
				$sql->orWhere('status', '=', 'InProgress');
				$sql->orWhere('status', '=', 'Completed');
			})
			->count();
		$this->count_completed = CampaignStudent::where('campaign_id', '=', $this->id)->where('status', '=', 'Completed')->count();

		if($this->count_total > 0)
		{
			$this->started_progress = round($this->count_started / $this->count_total * 100);
			$this->completed_progress = round($this->count_completed / $this->count_total * 100);
		}

		$this->save();
	}

	public function generateResults()
	{
		CampaignStat::where('campaign_id', '=', $this->id)->delete();

		$groupings = SurveyGrouping::where('survey_id', '=', $this->survey_id)->get();

		foreach ($groupings as $group)
		{
			$questions = $this->survey->questions;

			$question_ids = [];

			foreach ($group->questions as $question)
			{
				$question_ids[] = $question->id;
			}

			if (!empty($question_ids))
			{
				$strong_count = CampaignResult::where('campaign_id', '=', $this->id)->whereIn('result', [1,2,3])->whereIn('question_id', $question_ids)->count();

				$strong_count = ceil($strong_count / count($question_ids));

				$vulnerable_count = CampaignResult::where('campaign_id', '=', $this->id)->whereIn('result', [4,5])->whereIn('question_id', $question_ids)->count();

				$vulnerable_count = floor($vulnerable_count / count($question_ids));

				$total = $strong_count + $vulnerable_count;

				if ($total > 0)
				{

					$strong_percentage = $strong_count / $total * 100;

					$vulnerable_percentage = $vulnerable_count / $total * 100;
				}
				else
				{
					$strong_percentage = 0;

					$vulnerable_percentage = 0;	
				}

				CampaignStat::create([
					'campaign_id'           => $this->id,
					'grouping_id'           => $group->id,
					'strong_percentage'     => $strong_percentage,
					'vulnerable_percentage' => $vulnerable_percentage,
					'strong_count'          => $strong_count,
					'vulnerable_count'      => $vulnerable_count,
				]);
			}
		}
	}
	public function getImproveResults()
	{
		$data[$this->id] = [];
		$class = Classroom::with('students')->find($this->class_id);
		
		$groupings = SurveyGrouping::where('survey_id', '=', $this->survey_id)->get();
		foreach ($groupings as $group)
		{	$studentCount = 0;
			foreach($class->students as $student);
			{
				
				$questions = $this->survey->questions;

				$question_ids = [];

				foreach ($group->questions as $question)
				{
					$question_ids[] = $question->id;
				}

				if (!empty($question_ids))
				{
					
					$count = CampaignResult::where('campaign_id', '=', 15)->where('campaign_student_id', '=', $student->id)->whereIn('result',[1,2,3])->whereIn('question_id', $question_ids)->get();
					if(!empty($count))
					{
						$studentCount++;
					}
				}
			}
			array_push($data[$this->id], array($group->title,$studentCount));
		}

		return $data[$this->id];
	}

}