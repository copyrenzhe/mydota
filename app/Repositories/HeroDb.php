<?php
namespace App\Repositories;

use App\Models\Hero;
use DB;

Class HeroDb
{
    public function update()
    {
        $HeroHtml = http_curl('http://www.dota2.com/jsfeed/heropediadata?feeds=herodata&l=schinese');
        $HeroData = json_decode($HeroHtml);
        $HeroAll = $HeroData->herodata;
        foreach($HeroAll as $name => $HeroObj){
            $Hero['name'] = $name;
            $Hero['dname'] = $HeroObj->dname;
            $Hero['u'] = $HeroObj->u;
            $Hero['pa'] = $HeroObj->pa;
            $Hero['dac'] = $HeroObj->dac;
            $Hero['droles'] = $HeroObj->droles;
            $Hero['str_b'] = $HeroObj->attribs->str->b;
            $Hero['str_g'] = $HeroObj->attribs->str->g;
            $Hero['int_b'] = $HeroObj->attribs->int->b;
            $Hero['int_g'] = $HeroObj->attribs->int->g;
            $Hero['agi_b'] = $HeroObj->attribs->agi->b;
            $Hero['agi_g'] = $HeroObj->attribs->agi->g;
            $Hero['ms'] = $HeroObj->attribs->ms;
            $Hero['dmg_min'] = $HeroObj->attribs->dmg->min;
            $Hero['dmg_max'] = $HeroObj->attribs->dmg->max;
            $Hero['armor'] = $HeroObj->attribs->armor;
            $this->save($Hero);
        }
    }

    public function load($name)
    {
        if(Hero::where('name','=',$name)->first()){
            return Hero::where('name','=',$name)->first();
        }else{
            return false;
        }
    }

    public function getImgUrlById($id, $lg=false)
    {
        $hero = Hero::find($id);
        if($hero)
            return $lg?'http://cdn.dota2.com/apps/dota2/images/heroes/'.$hero->name.'_hphover.png':'http://cdn.dota2.com/apps/dota2/images/heroes/'.$hero->name.'_sb.png';
        else
            return false;
    }

    public function getFieldById($id, $column = 'name')
    {
        return Hero::find($id)->$column;
    }

    public function save(array $data)
    {
        if(Hero::where('name','=',$data['name'])->first()){
            $result = Hero::where('name','=',$data['name'])->update($data);
        }else{
            $result = Hero::create($data);
        }
        return $result;
    }
}


?>