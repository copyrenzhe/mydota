@extends('match.app')

@section('content')
<div class="content">
	<div class="hero-header">
		<div class="hero-img">
			<img src="{{$heroDb->getImgUrlById($hero->id,true)}}" alt="" title="{{$hero->dname}}">
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

	<div class="ability">
		
	</div>
</div>
@stop