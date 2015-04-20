<?php namespace App\Models;

class SurveyGrouping extends \App\Models\Model {

	protected $table = 'survey_groupings';

	protected $fillable = ['survey_id','title'];

	protected $hidden = ['deleted_at'];

	public function survey()
	{
		return $this->belongsTo('App\Models\Survey');
	}

	public function questions()
	{
		return $this->belongsToMany('App\Models\SurveyQuestion','survey_grouping_question','grouping_id','question_id');
	}

	public static function getTitle(){
        $competency = self::select('id','title')->groupBy('title')->get();
        $array = [];
        foreach ($competency as $competency)
        {
            $array[$competency->title] = $competency->title;
        }
        $array['Other'] = 'Others';
        return $array;
    }
}