<?php
namespace App\Repositories;

use App\Models\Item;
use DB;

Class ItemsDb
{
	public function update()
	{
		$itemHtml = http_curl('http://www.dota2.com/jsfeed/heropediadata?feeds=itemdata&l=schinese');
        $itemData = json_decode($itemHtml);
        $itemAll = $itemData->itemdata;
        foreach($itemAll as $name => $itemObj){
            $item = (array) $itemObj;
            $item['name'] = $name;
            $this->save($item);
        }
	}

	public function load($name)
	{
		if(Item::where('name','=',$name)->first()){
			return Item::where('name','=',$name)->first();
		}else{
			return false;
		}
	}

	public function getFieldById($id, $column = 'name')
    {
        return Item::find($id)->$column;
    }

	public function getImgUrlById($id)
	{
		$item = Item::find($id);
		if($item)
			return 'http://cdn.dota2.com/apps/dota2/images/items/'.$item->img;
		else
			return false;
	}

	public function save(array $data)
	{
		$id = $data['id'];
		if($data['components']){
			$data['components'] = implode(',', $data['components']);
		}
		if(Item::find($id)){
			$result = Item::where('id','=',$id)->update($data);
		}else{
			$result = DB::table('item')->insert($data);
		}
		return $result;
	}
}

?>