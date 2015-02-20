<?php namespace App\Models;

use \App\Models\CampaignStudent;

class Campaign extends \App\Models\Model {

	protected $table = 'campaigns';

	protected $fillable = ['school_id', 'class_id', 'title', 'survey_id', 'count_total', 'count_started', 'count_completed', 'started_progress', 'completed_progress', 'status'];

	public function survey()
	{
		return $this->belongsTo('App\Models\Survey');
	}

	public function students()
	{
		return $this->hasMany('App\Models\CampaignStudent', 'campaign_id');
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

}