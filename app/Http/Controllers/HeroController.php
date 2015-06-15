<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Heroes;
use Illuminate\Http\Request;
use App\Models\Hero;

class HeroController extends Controller {

	/**
	 * Display a listing of the hero.
	 *
	 * @return Response
	 */
	public function index()
	{
		$hero = new Heroes;
		$hero->setHeroName('bane');
		$r = $hero->load();
		dd($r);
	}


}
