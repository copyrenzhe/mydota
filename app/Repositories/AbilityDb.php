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

    /**
     * @param  int  $id ability'id
     * @param  integer $lg 1 or 2
     * @return string      img url of ability
     */
    public function getImgUrlById($id, $lg=1)
    {
        $ability = Ability::find($id);
        if($ability){
            return 'http://cdn.dota2.com.cn/apps/dota2/images/abilities/'.$ability->name.'_hp'.$lg.'.png';
        }
        return false;
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