<?php namespace App\Models;

class UserAssoc extends \App\Models\Model {

	protected $table = 'user_associations';

	protected $fillable = ['school_board_id', 'school_id', 'user_id'];

}