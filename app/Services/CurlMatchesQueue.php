<?php

use App\Repositories\MatchesMapperAll;
use App\Repositories\MatchesDb;
use Dota2Api\Mappers\MatchMapperWeb;

class CurlMatchesQueue
{

    public function fire($job, $data)
    {
        Dota2Api\Api::init(API_KEY, array('localhost', 'root', 'root', 'dota2_db', ''), true);
        $matchesMapperWeb = new MatchesMapperAll();
        if (isset($data['steamid'])) {
            $matchesMapperWeb->setAccountId($data['steamid']);
        } else {
        }
        $matchesShortInfo = $matchesMapperWeb->load2();
        // var_dump($matchesShortInfo);
        foreach ($matchesShortInfo as $matchid => $matchShortInfo) {
            $matchMapper = new MatchMapperWeb($matchid);
            $match = $matchMapper->load();
            $mm = new MatchesDb();
            $mm->save($match, true);
        }
        $job->delete();
    }
}
