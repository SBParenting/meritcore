<?php

class Profile extends BaseModel {

	protected $table = 'user_profiles';

	protected $fillable = ['first_name', 'last_name', 'daytime_phone', 'evening_phone', 'mobile_phone', 'address_street', 'address_city', 'address_postal_code', 'address_province', 'notes'];

}