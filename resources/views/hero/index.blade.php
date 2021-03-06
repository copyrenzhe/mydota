@extends('layouts.app')
@section('styles')
	<link rel="stylesheet" href="{{ asset('css/hero.css') }}">
@stop

@section('content')
<div class="allhero">
	<div class="strhero">
		<div class="columnHeader">
			<span class="column" id="columnStr">力量</span>
		</div>
		<div class="herolist">
			@foreach($heroStr as $key=>$item)
				<a href="{{ url('/hero/'.$item->name) }}">
					<img src="{{$hero->getImgUrlById($item->id)}}" alt="" title="{{$item->dname}}">
				</a>
			@endforeach
		</div>
	</div>

	<div class="agihero">
		<div class="columnHeader">
			<span class="column" id="columnAgi">敏捷</span>
		</div>
		<div class="herolist">
			@foreach($heroAgi as $key=>$item)
				<a href="{{ url('/hero/'.$item->name) }}">
					<img src="{{$hero->getImgUrlById($item->id)}}" alt="" title="{{$item->dname}}">
				</a>
			@endforeach
		</div>
	</div>

	<div class="inthero">
		<div class="columnHeader">
			<span class="column" id="columnInt">智力</span>
		</div>
		<div class="herolist">
			@foreach($heroInt as $key=>$item)
				<a href="{{ url('/hero/'.$item->name) }}">
					<img src="{{$hero->getImgUrlById($item->id)}}" alt="" title="{{$item->dname}}">
				</a>
			@endforeach
		</div>
	</div>
</div>
@stop