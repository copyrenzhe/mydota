<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Match;
use App\Repositories\SteamRepository as Steam;
use App\Models\User;

class ApiController extends Controller
{

    public function __construct()
    {
        // Api::init(API_KEY, array('localhost', 'root', 'root', 'dota2_db', ''), true);
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
        $result = json_decode($r, true);
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
        $url = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=C44A91C0289CDD80307D3C76CC9522F2&steamid=' . $steamid . '&format=json&include_played_free_games=1&include_appinfo=1&appids_filter[0]=570';
        $r = http_curl($url);
        $result = json_decode($r, true);
        return $result['response']['game_count'];
    }

    /**
     * get Player's matches histroy of dota2
     * @param  long $steamid 64byte steamId or 32byte steamId
     * @return string
     */
    public function getPlayerMatches($steamid = null)
    {
        \Queue::push('CurlPlayerMatchesQueue', ['steamid' => $steamid]);
        return 'Added to the queue!';
        // dd($matchesShortInfo);
    }

    /**
     * get History matches sort by skill
     * @param  int $skill 0:any 1:normal 2:hard 3:very hard
     * @return string 
     */
    public function getHistoryMatches($skill)
    {
        $start_match_id = Match::ofSkill($skill)->orderBy('match_id', 'desc')->pluck('match_id');
        \Queue::push('CurlHistoryMatchesQueue', ['skill' => $skill, 'start_match_id' => $start_match_id]);
        return 'History matches Added to the queue!';
    }

    /**
     * update Items
     * @return string
     */
    public function getItemsWeb()
    {
        \Queue::push('CurlItemsQueue', ['language' => 'zh']);
        return 'Added to the queue!';
    }

    /**
     * update Heroes
     * @return string
     */
    public function getHeroesWeb()
    {
        \Queue::push('CurlHeroesQueue', ['language' => 'zh']);
        return 'Added to the queue!';
    }

    /**
     * create the map of the game
     * @param  int $matchid 
     * @return string    the html
     */
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

    /**
     * search from steam
     * @param  string $text user's name
     * @return array  result of search
     */
    public function search($text)
    {
        // Steam::init('lamp');
        $search_r = Steam::init($text);
        return $search_r;
    }

    /**
     * send mails subscribe
     * @return  string
     */
    public function sendMails()
    {
        $userList = User::where('is_subscribe','=',1)->get();
        foreach ($userList as $key => $user) {
            # code...
        }
        // \Queue::push('sendMailsQueue',['userList'=>$userList]);
        // return 'mail subscribe add to queue!';
    }

    public function test()
    {
        $playersMapperWeb = new \Dota2Api\Mappers\PlayersMapperWeb();
        $playersInfo = $playersMapperWeb->addId('76561198134591399')->load();
        foreach ($playersInfo as $playerInfo) {
            echo $playerInfo->get('avatar') . '<br/>';
            echo $playerInfo->get('profileurl') . '<br/>';
        }
        dd($playersInfo);
    }

}
