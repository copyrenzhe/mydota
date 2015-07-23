<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use App\Models\Slot;
use App\Http\Controllers\Controller;
use Dota2Api\Mappers\MatchesMapperDb;

use Illuminate\Http\Request;

class PlayerController extends Controller {

	/**
	 * Display a listing of the resource.
	 * testUrl : http://localhost:8000/player/detail/111720141
	 * @return Response
	 */
	public function index($account_id)
	{
		$info = User::find($account_id);
		$matchesMapperDb = new MatchesMapperDb();
		$matches = $matchesMapperDb->setAccountId($account_id)->load();
		$winNum = 0;
		foreach ($matches as $match_id => $match) {
			$radiantWin = $match->get('radiant_win');
			foreach ($match->getAllSlots() as $key => $slot) {
				if($slot->get('account_id') == $account_id){
					$getWin = $key>5?1:0;
					$winNum += $radiantWin^$getWin;
				}
			}
		}
		$winRate = formatFloat($winNum/count($matches));
		return view('player.index',compact('info'));	
	}


}
