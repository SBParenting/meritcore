<?php namespace App\Models;

class Campaign extends \App\Models\Model {

	protected $table = 'campaigns';

	protected $fillable = [];

	public function surveys()
	{
		return $this->belongsToMany('App\Models\Survey', 'campaign_surveys');
	}

}