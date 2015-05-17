<?php

use App\Repositories\ItemsWeb;
use Dota2Api\Mappers\ItemsMapperDb;

/**
 *
 */
class CurlItemsQueue
{
    public function fire($job, $data)
    {
        Dota2Api\Api::init(API_KEY, array('localhost', 'root', 'root', 'dota2_db', ''), true);
        $itemsMapperWeb = new ItemsWeb();
        $itemsMapperWeb->setLanguage($data['language']);
        $items = $itemsMapperWeb->load();
        $itemsMapperDb = new itemsMapperDb();
        $itemsMapperDb->save($items);
        $job->delete();
    }
}
