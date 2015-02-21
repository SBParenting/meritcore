<?php

class CampaignStudent extends BaseModel {

	protected $table = 'campaign_students';

	protected $fillable = ['campaign_id', 'student_id', 'secret', 'status'];
}