<?php

use App\Repositories\MatchesMapperAll;
use Dota2Api\Mappers\MatchMapperWeb;
use Dota2Api\Mappers\MatchMapperDb;

class CurlMatchesQueue{

	public function fire($job, $data)
	{
		Dota2Api\Api::init(API_KEY, array('localhost', 'root', 'root', 'dota2_db', ''), true);
		$matchesMapperWeb = new MatchesMapperAll();
        if (isset($data['steamid'])) {
            $matchesMapperWeb->setAccountId($data['steamid']);
        } else {
        }
        $matchesShortInfo = $matchesMapperWeb->load2();
        foreach ($matchesShortInfo as $matchid => $matchShortInfo) {
            $matchMapper = new MatchMapperWeb($matchid);
            $match = $matchMapper->load();
            $mm = new MatchMapperDb();
            $mm->save($match, false);
        }
		$job->delete();
	}
}

?>