<?php

use App\Repositories\MatchesDb;
use App\Repositories\MatchesMapperAll;
use Dota2Api\Mappers\MatchMapperWeb;

class CurlPlayerMatchesQueue
{

    public function fire($job, $data)
    {
        $matchesMapperWeb = new MatchesMapperAll();
        $matchesMapperWeb->setAccountId($data['steamid']);
        $matchesShortInfo = $matchesMapperWeb->load2();
        // var_dump($matchesShortInfo);
        foreach ($matchesShortInfo as $matchid => $matchShortInfo) {
            $matchMapper = new MatchMapperWeb($matchid);
            $match = $matchMapper->load();
            $mm = new MatchesDb();
            $mm->save($match, false);
        }
        $job->delete();
    }
}
