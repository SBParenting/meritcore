<?php namespace App\Models;

use \App\Models\CampaignStudent;
use \App\Models\CampaignStat;
use \App\Models\SurveyGrouping;
use \App\Models\SurveyQuestion;

class Projects extends \App\Models\Model {

	protected $table = 'projects';

	protected $fillable = ['project_name', 'email', 'street', 'city', 'province', 'country', 'postal_code'];

	public static $sortable = ['project_name', 'city', 'email', 'province'];

	public static $defaultSort = ['project_name', 'asc'];

	public function schools()
    {
        return $this->belongsToMany('App\Models\School', 'school_projects', 'project_id', 'school_id');
    }

    public static function getSchools($schools){
        
        foreach ($schools as $school)
        {
            $array[$school->id] = $school->name;
        }
        return $array;
    }
}