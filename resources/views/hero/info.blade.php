@extends('layouts.app')

@section('content')
<style>
    .hero-detail{
        width: 270px;
        float:left;
    }
    .hero-detail div{
        margin-left:10px;
        margin-top: 10px;
    }
    .hero-detail .base-upgrade{
        float: left;
        line-height: 33px;
        font-size: 14px;
        font-weight: bold;
    }
</style>
<div class="content">
	<div class="hero-header">
		<div class="hero-img">
			<img src="{{$heroDb->getImgUrlById($hero->id,2)}}" alt="" title="{{$hero->dname}}">
		</div>
		<div class="hero-info">
			<span class="hero-name">
				{{$hero->dname}}
			</span>
			<span class="droles">
				{{$hero->dac}}-{{$hero->droles}}
			</span>
		</div>
	</div>
	<div class="history">
		
	</div>
	
	<div class="hero-detail">
        <div>
            <em>生命值</em>
            <span>
                {{150+$hero->str_b*19}}
            </span>
        </div>
        <div>
            <em>魔法值</em>
            <span>
                {{$hero->int_b*13}}
            </span>
        </div>
		<img src="http://cdn.dota2.com.cn/apps/dota2/images/heropedia/overviewicon_str.png" alt="">
        <div class="base-upgrade">
            <span>{{$hero->str_b}}</span> + <span>{{$hero->str_g}}</span>
        </div>
        <img src="http://cdn.dota2.com.cn/apps/dota2/images/heropedia/overviewicon_agi.png" alt="">
        <div class="base-upgrade">
            <span>{{$hero->agi_b}}</span> + <span>{{$hero->agi_g}}</span>
        </div>
        <img src="http://cdn.dota2.com.cn/apps/dota2/images/heropedia/overviewicon_int.png" alt="">
        <div class="base-upgrade">
            <span>{{$hero->int_b}}</span> + <span>{{$hero->int_g}}</span>
        </div>
        <img src="http://cdn.dota2.com.cn/apps/dota2/images/heropedia/overviewicon_attack.png" alt="">
        <div class="base-upgrade">
            @if($hero->pa=='str')
                <span>{{$hero->min+$hero->str_b}}</span> - <span>{{$hero->max+$hero->str_b}}</span>
            @elseif($hero->pa=='agi')
                <span>{{$hero->min+$hero->agi_b}}</span> - <span>{{$hero->max+$hero->agi_b}}</span>
            @else
                <span>{{$hero->min+$hero->int_b}}</span> - <span>{{$hero->max+$hero->int_b}}</span>
            @endif
        </div>
        <img src="http://cdn.dota2.com.cn/apps/dota2/images/heropedia/overviewicon_speed.png" alt="">
        <div class="base-upgrade">
            <span>{{$hero->ms}}</span>
        </div>
        <img src="http://cdn.dota2.com.cn/apps/dota2/images/heropedia/overviewicon_defense.png" alt="">
        <div class="base-upgrade">
            <span>
                {{$hero->armor}}
            </span>
        </div>
	</div>

	<div class="abilities">
		@foreach($abilities as $ability)
            <div class="abilityRow">
                <div class="abilityIcon">
                    <img src="{{$abilityDb->getImgUrlById($ability->id,1)}}" alt="" title="{{$ability->dname}}">
                </div>
                
                <div class="abilityDesc">
                    <span>{{$ability->dname}}</span>
                        <?=$ability->desc?>
                </div>
                <div class="abilityAffects">
                    <?=$ability->affects?>
                </div>
                <div class="abilityAttrib">
                    <?=$ability->attrib?>
                </div>
                <div class="abilityCmb">
                    <?=$ability->cmb?>
                </div>
                <div class="abilityNotes">
                    <?=$ability->notes?>
                </div>
                <div class="abilityLore">
                    <?=$ability->lore?>
                </div>
            </div>
        @endforeach
	</div>
</div>
@stop