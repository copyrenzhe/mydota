<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Dota2Api\Api as Api;
use Dota2Api\Utils\Db;
use App\Repositories\SteamRepository as Steam;

class ApiController extends Controller {

	public function __construct()
	{
		// Api::init(API_KEY, array('localhost', 'root', '', 'dota2_db', ''), false);
	}


	/**
	 * Get Current numbers of Dota2's players
	 *
	 * @return int
	 */
	public function getNumberOfCurrentPlayers()
	{
		$url = 'http://api.steampowered.com/ISteamUserStats/GetNumberOfCurrentPlayers/v1?appid=570&format=json';
		$r = http_curl($url);
		$result = json_decode($r,true);
		return $result['response']['player_count'];
	}

	/**
	 * Judge the player is owned dota2 or not
	 * @param int $steam the steamid of player
	 * @return boolean
	 */
	public function ownedGame($steamid)
	{
		//dota2 is a free games and it's appid is 570
		//appids_filter is an array and should be passed like appids_filter[0]=440&appids_filter[1]=570
		$url = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=C44A91C0289CDD80307D3C76CC9522F2&steamid='.$steamid.'&format=json&include_played_free_games=1&include_appinfo=1&appids_filter[0]=570';
		$r = http_curl($url);
		$result = json_decode($r,true);
		return $result['response']['game_count'];
	}

    /**
     * get History of dota2
     * @param  long $steamid 64byte steamId or 32byte steamId
     * @return array  Arraylist of matches history
     */
	public function getHistoryMatches($steamid)
	{
		$matchesMapperWeb = new \Dota2Api\Mappers\MatchesMapperWeb();
		$matchesMapperWeb->setAccountId($steamid);
        $matchesShortInfo = $matchesMapperWeb->load();
        foreach ($matchesShortInfo as $key=>$matchShortInfo) {
            $matchMapper = new \Dota2Api\Mappers\MatchMapperWeb($key);
            $match[] = $matchMapper->load();
        }
	}

	public function createMap($matchid)
	{
		$matchMapperWeb = new \Dota2Api\Mappers\MatchMapperWeb($matchid);
		$match = $matchMapperWeb->load();
		$map = new \Dota2Api\Utils\Map($match->get('tower_status_radiant'), $match->get('tower_status_dire'), $match->get('barracks_status_radiant'), $match->get('barracks_status_dire'));
		$canvas = $map->getImage();
		header('Content-Type: image/jpg');
		imagejpeg($canvas);
		imagedestroy($canvas);
	}

	public function search($text)
	{
		// Steam::init('lamp');
		// if()
		$search_r = Steam::init($text);
		return $search_r;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
