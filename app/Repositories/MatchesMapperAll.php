<?php
namespace App\Repositories;

use Dota2Api\Mappers\MatchesMapperWeb;
use Dota2Api\Models\Match;
use Dota2Api\Models\Slot;
use Dota2Api\Utils\Request;

/**
 * extend Dota2Api\Mappers\MatchesMapperWeb
 * @author maple <275804511@qq.com>
 */
class MatchesMapperAll extends MatchesMapperWeb
{

    protected function _getDataArray()
    {
        $data = get_object_vars($this);
        $ret = array();
        foreach ($data as $key => $value) {
            if ($key !== '_total_results' && null !== $value && !is_array($value)) {
                $ret[ltrim($key, '_')] = $value;
            }
        }
        return $ret;
    }

    public function setAccountId($accountId)
    {
        $this->_account_id = $accountId;
        return $this;
    }

    /**
     * extends \Dota2Api\Mappers\MatchesMapperWeb@load Get all matches
     * @return [type] [description]
     */
    public function load2()
    {
        $matches = array();
        $startMatchId = '';
        do {
            if ($startMatchId) {
                $this->setStartAtMatchId($startMatchId);
            }

            $request = new Request(self::STEAM_MATCHES_URL, $this->_getDataArray());

            $xml = $request->send();
            if (null === $xml) {
                continue;
            }

            if (isset($xml->matches)) {
                $this->_total_results = $xml->total_results;
                $this->_results_remaining = $xml->results_remaining;
                foreach ($xml->matches as /* @var $m_matches array */$m_matches) {
                    foreach ($m_matches as $m) {
                        $match = new Match();
                        $match->setArray((array) $m);
                        foreach ($m->players as /* @var $players array */$players) {
                            foreach ($players as $player) {
                                $slot = new Slot();
                                $slot->setArray((array) $player);
                                $match->addSlot($slot);
                            }
                        }
                        $matches[$match->get('match_id')] = $match;
                        $startMatchId = $match->get('match_id');
                    }
                }
            }
        } while ($this->_results_remaining > 0);
        return $matches;
    }
}
