<?php namespace App\Models;

class CampaignStudent extends \App\Models\Model {

	protected $table = 'campaign_students';

	protected $fillable = ['campaign_id', 'student_id', 'secret', 'status', 'count_total', 'count_completed'];

	public function campaign()
	{
		return $this->belongsTo('App\Models\Campaign');
	}

	public function student()
	{
		return $this->belongsTo('App\Models\Student');
	}

	public static function findByKey($key)
	{
		return self::where('secret', '=', $key)->first();
	}

	public function getProgress()
	{
		if ($this->count_total > 0)
		{
			return $this->count_completed / $this->count_total * 100;
		}

		return 0;
	}

	public function updateRecord()
	{
//		$this->count_completed = CampaignResult::where('campaign_id', '=', $this->campaign_id)->where('campaign_student_id', '=', $this->id)->where('result', '>', '0')->count();

		$this->save();
	}
}