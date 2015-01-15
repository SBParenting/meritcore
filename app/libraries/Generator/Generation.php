<?php namespace Libraries\Generator;

class Generation extends \Eloquent {

	protected $table = 'generations';

	protected $fillable = ['path', 'entity'];
}