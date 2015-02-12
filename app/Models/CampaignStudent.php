<?php namespace App\Models;

class CampaignStudent extends \App\Models\Model {

	protected $table = 'campaign_students';

	protected $fillable = [];

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
}