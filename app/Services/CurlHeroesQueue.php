<?php

use App\Repositories\Heroes;
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
            $hero = new Heroes();
            $hero->setHeroName($value['name']);
            $r = $hero->load();
            $r['name'] = $value['name'];
            $r['localized_name'] = $value['localized_name'];

            if(Hero::where('name','=',$r['name'])->first()){
                Hero::where('name','=',$r['name'])->update($r);
            }else{
                Hero::create($r);
            }
        }
        $heroList['heroes'] = $result['result']['heroes'];
        update_dota2_json('heroes', $heroList);
        $job->delete();
    }
}
