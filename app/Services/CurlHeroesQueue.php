<?php

use App\Repositories\HeroDb;
use App\Models\Hero;

/**
 * update hero into database from web
 * update heroes.json from web
 */
class CurlHeroesQueue
{
    public function fire($job, $data)
    {
        $content = http_curl('https://api.steampowered.com/IEconDOTA2_570/GetHeroes/v0001/?key=' . API_KEY . '&language=' . $data['language']);
        $result = json_decode($content, true);
        foreach ($result['result']['heroes'] as $key => $value) {
            $r = array();
            $value['name'] = substr($value['name'], 14);
            $result['result']['heroes'][$key] = $value;

        }
        $heroDb = new HeroDb();
        $heroDb->update();
        $heroList['heroes'] = $result['result']['heroes'];
        update_dota2_json('heroes', $heroList);
        $job->delete();
    }
}
