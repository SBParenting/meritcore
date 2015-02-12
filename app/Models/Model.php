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

    protected static function getSort($sort, $order)
    {
        if (\Input::has('sort') && \Input::has('order'))
        {
            self::$sorting = (object)[
                'sort'  => \Input::get('sort'),
                'order' => \Input::get('order'),
            ];
        }
        else 
        {           
            self::$sorting = (object)[
                'sort'  => $sort,
                'order' => $order,
            ];
        }

        return self::$sorting;
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
