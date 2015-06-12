<?php namespace App\Http\Controllers;

use Dota2Api\Mappers\HeroesMapper;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

	/**
	 * Hero List
	 * @param string $hero_name 
	 * 
	 */
	public function heros($hero_name)
	{
		if(!$hero_name){
			$heroesMapper = new Dota2Api\Mappers\HeroesMapper();
			$heroes = $heroesMapper->load();
			return view('hero_list');
		} else{

		}
	}

	/**
	 * search player name
	 * @param string $text player's name
	 * 
	 */
	public function search($text)
	{
		
	}

}
