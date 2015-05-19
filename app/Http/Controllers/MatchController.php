<?php namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use Dota2Api\Mappers\MatchMapperDb;
use Dota2Api\Data\heroes;
use Dota2Api\Data\items;
use Dota2Api\Data\abilities;
use Dota2Api\Data\mods;
use Dota2Api\Data\lobbies;
use Dota2Api\Data\regions;
use Dota2Api\Models\Match;
use Dota2Api\Models\Player;
use Dota2Api\Mappers\PlayersMapperDb;

class MatchController extends Controller {

	//
	public function info($matchid)
	{
        $mm = new MatchMapperDb($matchid);
        $match = $mm->load();
        if(is_null($match->get('match_id'))){
            die('<p>Match does not exists.</p>');
        }
        $playersMapperDb = new PlayersMapperDb();
        foreach ($match->getAllSlots() as $slot) {
            if($slot->get('account_id') != player::ANONYMOUS ) {
                $playersMapperDb->addId(player::convertId($slot->get('account_id')));
            }
        }
        $player = $playersMapperDb->load();
        $heroes = new heroes();
        $heroes->parse();
        $items = new items();
        $items->parse();
        $abilities = new abilities();
        $abilities->parse();
        $mods = new mods();
        $mods->parse();
        $lobbies = new lobbies();
        $lobbies->parse();
        $regions = new regions();
        $regions->parse();
        $data = array(
            'empty_item_id' => item::empty_id,
            'anonymous' => player::ANONYMOUS
            );
        if($match->get('game_mode') == match::CAPTAINS_MODE){
            $data['captains'] = true;
            $data['picks_bans'] = $match->getAllPicksBansDivided();
        }
        foreach($match->getAllSlotsDivided() as $k => $team){
            $detail[$k]['count'] = array('level'=>0,'k'=>0,'d'=>0,'a'=>0,'gold'=>0,'lh'=>0,'dn'=>0,'gpm'=>0,'xpm'=>0,'hdmg'=>0,'tdmg'=>0,'heal'=>0);
            foreach ($team as $key => $slot) {
                //detail info
                $detail[$k][$key]['account_id'] = $slot->get('account_id');
                $detail[$k][$key]['steam_id'] = player::convertId($slot->get('account_id'));
                $detail[$k][$key]['gold'] = round($match->get('duration')*$slot->get('gold_per_min') / 60 / 1000, 1);
                $detail[$k][$key]['level'] = $slot->get('level'); 
                $detail[$k][$key]['k'] = $slot->get('kills');
                $detail[$k][$key]['d'] = $slot->get('deaths');
                $detail[$k][$key]['a'] = $slot->get('assists');
                $detail[$k][$key]['kda'] = round(($slot->get('kills')+$slot->get('assists'))/$slot->get('deaths'),1);
                $detail[$k][$key]['gold'] = $gold;
                $detail[$k][$key]['lh'] = $slot->get('last_hits');
                $detail[$k][$key]['dn'] = $slot->get('denies');
                $detail[$k][$key]['gpm'] = $slot->get('gold_per_min');
                $detail[$k][$key]['xpm'] = $slot->get('xp_per_min');
                $detail[$k][$key]['hdmg'] = $slot->get('hero_damage');
                $detail[$k][$key]['tdmg'] = $slot->get('tower_damage');
                $detail[$k][$key]['heal'] = $slot->get('hero_healing');
                for($i = 0; $i <=5; $i++){
                    $detail[$k][$key]['item_'.$i] = $slot->get('item_'.$i);
                }
                //total info
                $detail[$k][$key]['total']['level'] += $slot->get('level'); 
                $detail[$k][$key]['total']['k'] += $slot->get('kills');
                $detail[$k][$key]['total']['d'] += $slot->get('deaths');
                $detail[$k][$key]['total']['a'] += $slot->get('assists');
                $detail[$k][$key]['total']['gold'] += $gold;
                $detail[$k][$key]['total']['lh'] += $slot->get('last_hits');
                $detail[$k][$key]['total']['dn'] += $slot->get('denies');
                $detail[$k][$key]['total']['gpm'] += $slot->get('gold_per_min');
                $detail[$k][$key]['total']['xpm'] += $slot->get('xp_per_min');
                $detail[$k][$key]['total']['hdmg'] += $slot->get('hero_damage');
                $detail[$k][$key]['total']['tdmg'] += $slot->get('tower_damage');
                $detail[$k][$key]['total']['heal'] += $slot->get('hero_healing');
             } 
        }
        $data['detail'] = $detail;

		return view('match.info',compact('match', 'player', 'heroes','items','abilities','mods','lobbies','regions','data'));
	}

}
