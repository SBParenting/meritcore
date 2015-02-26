<?php

class CampaignResult extends BaseModel {

	protected $table = 'campaign_results';

	protected $fillable = ['campaign_student_id', 'campaign_id', 'student_id', 'question_id', 'result'];
}