<?php
namespace App\Http\Controllers;

use Dota2Api\Data\Abilities;
use Dota2Api\Data\Heroes;
use Dota2Api\Data\Items;
use Dota2Api\Data\Lobbies;
use Dota2Api\Data\Mods;
use Dota2Api\Data\Regions;
use Dota2Api\Mappers\MatchMapperDb;
use Dota2Api\Mappers\PlayersMapperDb;
use Dota2Api\Models\Match;
use Dota2Api\Models\Player;

class MatchController extends Controller
{

    //
    public function info($matchid)
    {
        $mm = new MatchMapperDb($matchid);
        $match = $mm->load();
        if (is_null($match->get('match_id'))) {
            die('<p>Match does not exists.</p>');
        }
        $playersMapperDb = new PlayersMapperDb();
        foreach ($match->getAllSlots() as $slot) {
            if ($slot->get('account_id') != Player::ANONYMOUS) {
                $playersMapperDb->addId(Player::convertId($slot->get('account_id')));
            }
        }
        $players = $playersMapperDb->load();
        $heroes = new Heroes();
        $heroes->parse();
        $items = new Items();
        $items->parse();
        $abilities = new Abilities();
        $abilities->parse();
        $mods = new Mods();
        $mods->parse();
        $lobbies = new Lobbies();
        $lobbies->parse();
        $regions = new Regions();
        $regions->parse();
        $data = array(
            'empty_item_id' => Items::EMPTY_ID,
            'anonymous' => Player::ANONYMOUS,
            'captains' => false,
            'picks_bans' => false,
        );
        if ($match->get('game_mode') == Match::CAPTAINS_MODE) {
            $data['captains'] = true;
            $data['picks_bans'] = $match->getAllPicksBansDivided();
        }
        foreach ($match->getAllSlotsDivided() as $k => $team) {
            $detail[$k]['total'] = array('level' => 0, 'k' => 0, 'd' => 0, 'a' => 0, 'gold' => 0, 'lh' => 0, 'dn' => 0, 'gpm' => 0, 'xpm' => 0, 'hdmg' => 0, 'tdmg' => 0, 'heal' => 0);
            foreach ($team as $key => $slot) {
                //detail info
                $detail[$k][$key]['account_id'] = $slot->get('account_id');
                $detail[$k][$key]['steam_id'] = Player::convertId($slot->get('account_id'));
                $detail[$k][$key]['gold'] = round($match->get('duration') * $slot->get('gold_per_min') / 60 / 1000, 1);
                $detail[$k][$key]['level'] = $slot->get('level');
                $detail[$k][$key]['k'] = $slot->get('kills');
                $detail[$k][$key]['d'] = $slot->get('deaths');
                $detail[$k][$key]['a'] = $slot->get('assists');
                $detail[$k][$key]['kda'] = round(($slot->get('kills') + $slot->get('assists')) / $slot->get('deaths'), 1);
                $detail[$k][$key]['lh'] = $slot->get('last_hits');
                $detail[$k][$key]['dn'] = $slot->get('denies');
                $detail[$k][$key]['gpm'] = $slot->get('gold_per_min');
                $detail[$k][$key]['xpm'] = $slot->get('xp_per_min');
                $detail[$k][$key]['hdmg'] = $slot->get('hero_damage');
                $detail[$k][$key]['tdmg'] = $slot->get('tower_damage');
                $detail[$k][$key]['heal'] = $slot->get('hero_healing');
                $detail[$k][$key]['hero_id'] = $slot->get('hero_id');
                for ($i = 0; $i <= 5; $i++) {
                    $detail[$k][$key]['item_' . $i] = $slot->get('item_' . $i);
                }
                //total info
                $detail[$k]['total']['level'] += $slot->get('level');
                $detail[$k]['total']['k'] += $slot->get('kills');
                $detail[$k]['total']['d'] += $slot->get('deaths');
                $detail[$k]['total']['a'] += $slot->get('assists');
                $detail[$k]['total']['gold'] += round($match->get('duration') * $slot->get('gold_per_min') / 60 / 1000, 1);
                $detail[$k]['total']['lh'] += $slot->get('last_hits');
                $detail[$k]['total']['dn'] += $slot->get('denies');
                $detail[$k]['total']['gpm'] += $slot->get('gold_per_min');
                $detail[$k]['total']['xpm'] += $slot->get('xp_per_min');
                $detail[$k]['total']['hdmg'] += $slot->get('hero_damage');
                $detail[$k]['total']['tdmg'] += $slot->get('tower_damage');
                $detail[$k]['total']['heal'] += $slot->get('hero_healing');
            }
        }
        $data['detail'] = $detail;
        return view('match.info', compact('match', 'players', 'heroes', 'items', 'abilities', 'mods', 'lobbies', 'regions', 'data'));
    }

}
