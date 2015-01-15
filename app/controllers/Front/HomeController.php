<?php namespace Controllers\Front;

class HomeController extends \BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex($slug=false)
	{
		if ($slug===false)
		{
			return $this->getPage('home');
		}
		else
		{
			return $this->getPage($slug);
		}

		\App::abort(404);
	}

	public function getPage($slug)
	{
		$page = \Page::findBySlug($slug);

		if ($page)
		{
			return \View::make($this->page($slug))->with('page', $page);
		}

		\App::abort(404);
	}

	public function getPosts()
	{
		$posts = \Post::orderBy('date', 'desc')->take(5)->get();

		if ($posts)
		{
			return \View::make('front.pages.posts')->with('posts', $posts);
		}

		\App::abort(404);
	}

	public function getPost($slug=false)
	{
		$post = \Post::findBySlug($slug);

		if ($post)
		{
			return \View::make('front.pages.post')->with('post', $post);
		}

		\App::abort(404);
	}

	private function page($slug)
	{
		$view = 'front.pages.' . str_replace('-', '_', $slug);

		if (\View::exists($view)) return $view;	
		
		return 'front.pages.generic';	
	}

}
