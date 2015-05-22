<?php

use App\Repositories\MatchesDb;
use App\Repositories\MatchesMapperAll;
use Dota2Api\Mappers\MatchMapperWeb;

class CurlHistoryMatchesQueue
{

    public function fire($job, $data)
    {
        $matchesMapperWeb = new MatchesMapperAll();
        $matchesMapperWeb->setSkill($data['skill']);
        // $matchesMapperWeb->setStartAtMatchId($data['start_match_id']);
        $matchesShortInfo = $matchesMapperWeb->load2($data['start_match_id']);
        foreach ($matchesShortInfo as $matchid => $matchShortInfo) {
            $matchMapper = new MatchMapperWeb($matchid);
            $match = $matchMapper->load();
            $mm = new MatchesDb();
            $mm->save($match, false);
        }
        $job->delete();
    }
}
