<?php
namespace App\Repositories;

use PhpQuery\PhpQuery as phpQuery;

class Heroes
{
    const cookie = './dotamax.cookie';
    const REFERER = 'http://dotamax.com/hero/rate/';
    const USERAGENT = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36';
    const URL = 'http://dotamax.com/hero/detail/';
    protected $_heroName;
    protected $cookie;

    public function setHeroName($name)
    {
        $this->_heroName = $name;
        $this->cookie = '';
        return $this;
    }

    public function load()
    {   
        $url = self::URL.$this->_heroName;
        $html = $this->send($url);
        $pattern = '/<span style\=\"font\-size\:10px\;color\:\#ccc\;width\:320px\;\">(.*?)<\/span>.*?var health_add \= (.*?)\*19.*?var mana_add \= (.*?)\*13.*?var armor_add \= (.*?)\/7.*?var health_init \= 150\+(\d+)\*19.*?var mana_init \= (\d+)\*13.*?var attack_min \= (\d+).*?var attack_max \= (\d+).*?var armor_init \= (.*?)\+(\d+)\/7.*?\'DOTA\_ATTRIBUTE\_(.*?)\' \=\=.*?<span id\=\"armor\"><\/span><\/div>.*?<div class\=\"hero\-stats\">.*?<span>(\d+)<\/span>.*?<span id\=\"mana\"><\/span><\/div>.*?<div class\=\"hero\-stats\">.*?<span>(.*?)<\/span>.*?<span>(.*?)<\/span>/s';
        preg_match($pattern, $html, $matchs);
        $r = array(
            'type' => del_html($matchs[1]),
            'strength_add' => $matchs[2],
            'intellect_add' => $matchs[3],
            'agility_add' => $matchs[4],
            'strength_init' => $matchs[5],
            'intellect_init' => $matchs[6],
            'attack_min' => $matchs[7],
            'attack_max' => $matchs[8],
            'armor_init' => $matchs[9],
            'agility_init' => $matchs[10],
            'attribute' => strtolower($matchs[11]),
            'speed' => $matchs[12],
            'turn_speed' => $matchs[13],
            'front_cradle' => $matchs[14],
            );
        return $r;
    }

    private function send($url, $type = 'GET', $params = false)
    {
        $ch = curl_init($url); //初始化
        curl_setopt($ch, CURLOPT_HEADER, 0); //不返回header部分
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //返回字符串，而非直接输出
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie); //发送cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie); //存储cookies
        if ($type === "POST") {
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        if (!empty($params) && is_array($params)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_REFERER, self::REFERER);
        } else {
            curl_setopt($ch, CURLOPT_REFERER, self::REFERER);
        }
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, self::USERAGENT);
        $html = curl_exec($ch);
        //调试使用
        if ($html === false) {
            echo "cURL Error: " . curl_error($ch);
        }
        curl_close($ch);
        return $html;
    }
}
