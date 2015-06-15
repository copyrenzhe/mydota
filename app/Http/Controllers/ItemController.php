<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Repositories\ItemsDb;
use Illuminate\Http\Request;

class ItemController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$result = http_curl('http://www.dota2.com/jsfeed/heropediadata?feeds=abilitydata&l=schinese');
		$r = json_decode($result);
		dd($r);
	}

}
