@extends('match.app')

@section('content')
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
		
	</div>

	<div class="abilities">
		@foreach($abilities as $ability)
            <div class="abilityRow">
                <div class="abilityIcon">
                    <img src="{{$abilityDb->getImgUrlById($ability->id,1)}}" alt="" title="{{$ability->dname}}">
                </div>
                
                <div class="abilityDesc">
                    <span>{{$ability->dname}}</span>
                    <p>
                        {{$ability->desc}}
                    </p>
                </div>
                <div class="abilityAffects">
                    {{$ability->affects}}
                </div>
                <div class="abilityAttrib">
                    {{$ability->attrib}}
                </div>
                <div class="abilityNotes">
                    {{$ability->notes}}
                </div>
                <div class="abilityLore">
                    {{$ability->lore}}
                </div>
            </div>
        @endforeach
	</div>
</div>
@stop