<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Heroes;
use Illuminate\Http\Request;

class HeroController extends Controller {

	/**
	 * Display a listing of the hero.
	 *
	 * @return Response
	 */
	public function index()
	{
		$heroes = new Heroes();
		$heroes->setHeroName('nevermore');
		$heroesInfo = $heroes->load();
		dd($heroesInfo);
	}


}
