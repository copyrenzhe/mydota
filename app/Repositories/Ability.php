<?php
namespace App\Repositories;

use DB;

Class Ability
{
    public function update()
    {
        $abilityHtml = http_curl('http://www.dota2.com/jsfeed/heropediadata?feeds=abilitydata&l=schinese');
        $abilityData = json_decode($abilityHtml);
        $abilityAll = $abilityData->abilitydata;
        foreach($abilityAll as $name => $abilityObj){
            $ability = (array) $abilityObj;
            $ability['name'] = $name;
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

    public function save(array $data)
    {
        if(DB::table('ability')->where('name','=',$data['name'])){
            $result = DB::table('ability')->where('id','=',$id)->update($data);
        }else{
            $result = DB::table('item')->insert($data);
        }
        return $result;
    }
}


?>