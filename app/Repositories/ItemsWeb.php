<?php
namespace App\Repositories;

use Dota2Api\Mappers\ItemsMapperWeb;
use Dota2Api\Models\Item;
use Dota2Api\Utils\Request;

/**
 *
 */
class ItemsWeb extends ItemsMapperWeb
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

    public function load()
    {
        $request = new Request(
            self::ITEMS_STEAM_URL,
            $this->_getDataArray()
        );
        $response = $request->send();
        if (null === $response) {
            return null;
        }
        $itemsInfo = (array) ($response->items);
        $itemsInfo = $itemsInfo['item'];
        $items = array();
        foreach ($itemsInfo as $itemInfo) {
            $info = (array) $itemInfo;
            array_walk($info, function (&$v) {
                $v = (string) $v;
            });
            $item = new item();
            $item->setArray($info);
            $items[$info['id']] = $item;
        }
        return $items;
    }

}
