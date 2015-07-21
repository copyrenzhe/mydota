<?php namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Redirect;

class IndexController extends Controller {



	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$api = new ApiController();
		$data = array(
			'current_num' => $api->getNumberOfCurrentPlayers()
			);

		return view('index',['data'=> $data]);
	}


	/**
	 * search player name
	 * @param string $text player's name
	 * 
	 */
	public function search($text)
	{
		$lists = User::ofText($text)->get();
		if(count($lists)==1){
			return Redirect::route('player.detail',array('account_id'=>$lists[0]->account_id));
		}
		dd($lists);
	}

}
