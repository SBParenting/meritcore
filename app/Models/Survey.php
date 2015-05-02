<?php namespace App\Models;

class Survey extends \App\Models\Model {

	protected $table = 'surveys';

	protected $fillable = ['title'];

	protected $related = ['question' => 'App\Models\SurveyQuestion'];

	protected $relation_key = 'survey_id';

	public function questions()
	{
		return $this->hasMany('App\Models\SurveyQuestion');
	}

	public function getQuestions()
	{
		return $this->getRelated('question')->select('id', 'num', 'question')->orderBy('num', 'asc')->get();
	}

	public static function getListable($var=false)
    {
        $query   = static::initListable($var);
       
        $filters = static::initStatic($var);

        $sort = self::getSort();

        if (!empty($sort->sort) && in_array($sort->sort, self::$sortable))
        {
	        switch($sort->sort)
	        {
	            default:
	                $query->orderBy($sort->sort, $sort->order);

	        }
        }

        return $query;
    }

    public static function getSurveys()
    {
    	$data = self::select('id','title')->get();
        $array = [];
        foreach ($data as $data)
        {
            $array[$data->id] = $data->title;
        }
       
        return $array;
    }

    public static function getImage($id){
        if($id == 1 || $id == 3){
            return 'heroes';
        }
        else
        {
            return 'heroes2';
        }
    }

    public static function getTitle($id){
        //dd($id);
        $survey = self::where('id',$id)->first();
        //dd($survey);
        return $survey->title;
    }
}