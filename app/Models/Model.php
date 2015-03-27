<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent {

    public static $sorting;

	public function fields()
    {
        return $this->fillable;
    }

    public function validator()
    {
    	$class = "Services\\Validators\\" . get_class($this) . "Validator";

        return App::make($class);
    }

    public function input($input)
    {
    	return array_only($input, $this->fields());
    }

     public static function getSearch()
    {
        return \State::get('search');
    }

    public static function getSort($sort=false)
    {
        if ($sort===false)
        {
            return (object)['sort' => \State::get('sort'), 'order' => \State::get('order')];
        }
        else {
            return (object)['sort' => $sort[0], 'order' => $sort[1]];
        }
    }

    public static function initListable($var=false)
    {
        if ($var !== false)
        {
            if (is_object($var))
            {
                $query = $var;
            }
            elseif (is_array($var) && !empty($var['query'])) {

                $query = $var['query'];
            }
        }

        if (empty($query))
        {
            $query = static::query();
        }
    
        return $query;
    }

    public static function initStatic($var=false)
    {
        if ($var !== false && is_array($var))
        {
            if (!empty($var['static']))
            {
                return $var['static'];
            }

            return $var;
        }

        return false;
    }

    public function getRelated($type)
    {
        $relations = $this->related;

        if (array_key_exists($type, $relations))
        {
            return $relations[$type]::where($this->relation_key, '=', $this->id);
        }
    }
}
