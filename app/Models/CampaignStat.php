<?php namespace App\Models;

class CampaignStat extends \App\Models\Model {

	protected $table = 'campaign_stats';

	protected $fillable = ['campaign_id', 'grouping_id', 'strong_percentage', 'vulnerable_percentage', 'strong_count', 'vulnerable_count'];

	public function campaign()
	{
		return $this->belongsTo('App\Models\Campaign');
	}

	public function student()
	{
		return $this->belongsTo('App\Models\Student');
	}

	public function grouping()
	{
		return $this->belongsTo('App\Models\SurveyGrouping');
	}
}