<?php namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;

class MatchController extends Controller {

	//
	public function info($matchid)
	{
		return view('match.info');
	}

}
