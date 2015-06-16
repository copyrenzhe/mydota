<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\HeroDb;
use App\Repositories\AbilityDb;
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
		$hero = new HeroDb();
		$hero->update();
	}

	public function ability()
	{
		$ability = new AbilityDb();
		$ability->update();
	}


}
