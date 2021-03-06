<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $fillable = ['first_name', 'last_name', 'username', 'email', 'password', 'role_id', 'status', 'verification_code', 'locked', 'updatable', 'deletable'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public static $statusses = ['Active', 'Deactivated', 'Unverified'];

	public function role() 
    {
        return $this->belongsTo('Role');
    }

    public function permissions() 
    {
        return $this->hasMany('Permission');
    }

    public function profile()
    {
        return $this->hasOne('Profile');
    }

    public function hasRole($key) 
    {
        foreach($this->roles as $role){
    
            if($role->name === $key)
            {
                return true;
            }
        }

        return false;
    }

    public function getName($format="L, F")
    {
    	$string = str_replace("L", "{last}", $format);
    	$string = str_replace("F", "{first}", $string);

    	$string = str_replace("{last}", $this->last_name, $string);
    	$string = str_replace("{first}", $this->first_name, $string);

    	return $string;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    public function avatar($size=150)
    {
        return self::getAvatar($this->email, $size);
    }

    public function sendMail()
    {
        $user = $this;

        \Mail::send('emails.admin.user_info', ['user' => $user], function($message) use ($user)
        {
            $message->to($user->email, $user->getName())->subject( \Config::get('site.title') . " Login Information" );
        });
    }

    public static function getAvatar($email, $size=150)
    {
        return "http://www.gravatar.com/avatar/". md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    public static function getListable()
    {
        $query = self::select('users.*', 'roles.name as role')->leftJoin('roles', 'users.role_id', '=', 'roles.id');

        switch($sort = self::getSort('name', 'asc'))
        {
            case 'name':
                $query->orderBy('last_name', $sort->order)->orderBy('first_name', $sort->order);

            default:
                $query->orderBy($sort->sort, $sort->order);
        }

        return $query;
    }   

    public function updateProfile($data=false)
    {
        if ($data!==false)
        {
            $profile = $this->profile;

            if (empty($profile))
            {
                $profile = $this->profile()->save(new Profile);
            }

            $profile->fill($data)->save();
        }
    }  

}
