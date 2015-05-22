<?php

/**
 * update heroes.json from web
 */
class CurlHeroesQueue
{
    public function fire($job, $data)
    {
        $content = http_curl('https://api.steampowered.com/IEconDOTA2_570/GetHeroes/v0001/?key=' . API_KEY . '&language=' . $data['language']);
        $result = json_decode($content, true);
        foreach ($result['result']['heroes'] as $key => $value) {
            $value['name'] = substr($value['name'], 14);
            $result['result']['heroes'][$key] = $value;
        }
        $heroList['heroes'] = $result['result']['heroes'];
        update_dota2_json('heroes', $heroList);
        $job->delete();
    }
}
