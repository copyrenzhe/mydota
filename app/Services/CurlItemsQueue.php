<?php

use App\Repositories\ItemsWeb;
// use Dota2Api\Mappers\ItemsMapperDb;
use App\Repositories\ItemsDb;
/**
 *
 */
class CurlItemsQueue
{
    public function fire($job, $data)
    {
        foreach ($items as $key => $value) {
            $item['id'] = $key;
            $item['name'] = $value->get('name');
            $result['items'][] = $item;
        }
        update_dota2_json('items', $result);
        $itemDb = new ItemsDb();
        $itemDb->update();
        // $itemsMapperDb = new itemsMapperDb();
        // $itemsMapperDb->save($items);
        $job->delete();
    }
}
