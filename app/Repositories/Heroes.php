<?php
namespace App\Repositories;

use Dota2Api\Mappers\HeroesMapper;
use Dota2Api\Utils\Request;

class Heroes extends HeroesMapper
{

    protected $_language;

    public function setLanguage($language)
    {
        $this->_language = $language;
        return $this;
    }

    public function _getDataArray()
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

    /**
     * @return array
     */
    public function load()
    {
        $request = new Request(
            self::HEROES_STEAM_URL,
            $this->_getDataArray()
        );
        $response = $request->send();
        if (null === $response) {
            return null;
        }
        $heroes_info = (array) ($response->heroes);
        $heroes_info = $heroes_info['hero'];
        $heroes = array();
        foreach ($heroes_info as $hero_info) {
            $info = (array) $hero_info;
            $heroes[$info['id']] = $info;
        }
        return $heroes;
    }

    public function writeData($heroes = array())
    {
        foreach ($heroes as $key => $value) {

        }
    }
}
