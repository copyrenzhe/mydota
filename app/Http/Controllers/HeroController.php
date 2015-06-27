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
		$heroStr = Hero::ofType('str')->get();
		$heroAgi = Hero::ofType('agi')->get();
		$heroInt = Hero::ofType('int')->get();
		return view('hero.index',compact('hero','heroStr','heroAgi','heroInt'));
	}

	public function info($hero_name)
	{
		$hero = Hero::where('name','=',$hero_name)->get();
		dd($hero);
	}

	public function ability()
	{
		$ability = new AbilityDb();
		$ability->update();
	}


}
