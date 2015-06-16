<?php
namespace App\Repositories;

use App\Models\Ability;
use DB;

Class AbilityDb
{
    public function update()
    {
        $abilityHtml = http_curl('http://www.dota2.com/jsfeed/heropediadata?feeds=abilitydata&l=schinese');
        $abilityData = json_decode($abilityHtml);
        $abilityAll = $abilityData->abilitydata;
        foreach($abilityAll as $name => $abilityObj){
            $ability = (array) $abilityObj;
            $ability['name'] = $name;
            $this->save($ability);
        }
    }

    public function load($name)
    {
        if(Ability::where('name','=',$name)->first()){
            return Ability::where('name','=',$name)->first();
        }else{
            return false;
        }
    }

    public function save(array $data)
    {
        if(Ability::where('name','=',$data['name'])->first()){
            $result = Ability::where('name','=',$data['name'])->update($data);
        }else{
            $result = Ability::create($data);
        }
        return $result;
    }
}

?>