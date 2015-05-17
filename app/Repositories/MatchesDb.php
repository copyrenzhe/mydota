<?php
namespace App\Repositories;

use Dota2Api\Mappers\MatchMapperDb;
use Dota2Api\Utils\Db;
use Dota2Api\Models\Match;
use Dota2Api\Mappers\PlayersMapperWeb;
use Dota2Api\Models\Player;

/**
* 
*/
class MatchesDb extends MatchMapperDb
{
	
	/**
	 * extend MatchMapperDb@insert
     * @param $match
     */
    public function insert(Match $match)
    {
        $db = Db::obtain();
        $slots = $match->getAllSlots();
        if ($match->get('radiant_team_id')) {
            $db->insertPDO(Db::realTablename('teams'), array(
                'id' => $match->get('radiant_team_id'),
                'name' => $match->get('radiant_name')
            ));
        }


        if ($match->get('dire_team_id')) {
            $db->insertPDO(Db::realTablename('teams'), array(
                'id' => $match->get('dire_team_id'),
                'name' => $match->get('dire_name')
            ));
        }


        // save common match info
        $db->insertPDO(Db::realTablename('matches'), $match->getDataArray());
        // save accounts
        foreach ($slots as $slot) {
            if ((int)$slot->get('account_id') !== Player::ANONYMOUS) {
                $playersMapperWeb = new PlayersMapperWeb();
                $account_id = $slot->get('account_id');
                $steamid = Player::convertId($account_id);
                $playersInfo = $playersMapperWeb->addId($steamid)->load();
                $personaname = $playersInfo[$steamid]->get('personaname');
                $avatar = $playersInfo[$steamid]->get('avatar');
                $profileurl = $playersInfo[$steamid]->get('profileurl');
                $db->insertPDO(Db::realTablename('users'), array(
                    'account_id' => $account_id,
                    'steamid' => $steamid,
                    'personaname' => $personaname,
                    'avatar' => $avatar,
                    'profileurl' => $profileurl
                ));
            }
        }
        // save slots
        foreach ($slots as $slot) {
            $slotId = $db->insertPDO(Db::realTablename('slots'), $slot->getDataArray());
            // save abilities upgrade
            $aU = $slot->getAbilitiesUpgrade();
            if (count($aU) > 0) {
                $keys = array();
                $data = array();
                foreach ($aU as $ability) {
                    $keys = array_keys($ability); // yes, it will be reassigned many times
                    $data1 = array_values($ability);
                    array_unshift($data1, $slotId);
                    array_push($data, $data1);
                }
                reset($aU);
                array_unshift($keys, 'slot_id');
                $db->insertManyPDO(Db::realTablename('ability_upgrades'), $keys, $data);
            }
            $additionalUnit = $slot->getAdditionalUnitItems();
            if (count($additionalUnit) > 0) {
                $additionalUnit['slot_id'] = $slotId;
                $db->insertPDO(Db::realTablename('additional_units'), $additionalUnit);
            }
        }
        if ((int)$match->get('game_mode') === match::CAPTAINS_MODE) {
            $picksBans = $match->getAllPicksBans();
            $data = array();
            foreach ($picksBans as $pickBan) {
                $data1 = array();
                array_push($data1, $match->get('match_id'));
                array_push($data1, $pickBan['is_pick']);
                array_push($data1, $pickBan['hero_id']);
                array_push($data1, $pickBan['team']);
                array_push($data1, $pickBan['order']);
                array_push($data, $data1);
            }
            $db->insertManyPDO(
                Db::realTablename('picks_bans'),
                array('match_id', 'is_pick', 'hero_id', 'team', 'order'),
                $data
            );
        }
    }

    /**
     * @param Match $match
     * @param bool $lazy if false - update all data, if true - only possible updated data
     */
    public function update(Match $match, $lazy = true)
    {
        $db = Db::obtain();
        $slots = $match->getAllSlots();
        // update common match info
        $db->updatePDO(
            Db::realTablename('matches'),
            $match->getDataArray(),
            array('match_id' => $match->get('match_id'))
        );
        foreach ($slots as $slot) {
        	if ((int)$slot->get('account_id') !== Player::ANONYMOUS) {
	        	$playersMapperWeb = new PlayersMapperWeb();
	            $account_id = $slot->get('account_id');
	            $steamid = Player::convertId($account_id);
	            $playersInfo = $playersMapperWeb->addId($steamid)->load();
	            $personaname = $playersInfo[$steamid]->get('personaname');
	            $avatar = $playersInfo[$steamid]->get('avatar');
	            $profileurl = $playersInfo[$steamid]->get('profileurl');
	            // update accounts
	            $db->updatePDO(Db::realTablename('users'), array(
	                'account_id' => $account_id,
	                'steamid' => $steamid,
	                'personaname' => $personaname,
	                'avatar' => $avatar,
	                'profileurl' => $profileurl
	            ), array('account_id' => $account_id));
        	}
            // update slots
            if (!$lazy) {
                $db->updatePDO(
                    Db::realTablename('slots'),
                    $slot->getDataArray(),
                    array('match_id' => $slot->get('match_id'), 'player_slot' => $slot->get('player_slot'))
                );
            }
        }
    }
}

?>