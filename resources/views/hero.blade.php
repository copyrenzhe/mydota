@extends('match.app')
@section('styles')
	<link rel="stylesheet" href="{{ asset('css/hero.css') }}">
@stop

@section('content')
	<div class="strhero">
		<div class="columnHeader">
			<span class="column" id="columnStr">力量</span>
		</div>
		<div class="herolist">
			@foreach($heroStr as $key=>$hero)
				<a href="">
					<img src="{{$hero->getImgUrlById($key)}}" alt="">
				</a>
			@endforeach
		</div>
	</div>

	<div class="agihero">
		<div class="columnHeader">
			<span class="column" id="columnAgi">力量</span>
		</div>
		<div class="herolist">
			@foreach($heroAgi as $key=>$hero)
				<a href="">
					<img src="{{$hero->getImgUrlById($key)}}" alt="">
				</a>
			@endforeach
		</div>
	</div>

	<div class="inthero">
		<div class="columnHeader">
			<span class="column" id="columnInt">力量</span>
		</div>
		<div class="herolist">
			@foreach($heroInt as $key=>$hero)
				<a href="">
					<img src="{{$hero->getImgUrlById($key)}}" alt="">
				</a>
			@endforeach
		</div>
	</div>
@stop