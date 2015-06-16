<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\HeroDb;
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

	public function lists()
	{
		$result = http_curl('http://www.dota2.com/jsfeed/heropediadata?feeds=herodata&l=schinese');
		$r = json_decode($result);
		dd($r);
	}


}
