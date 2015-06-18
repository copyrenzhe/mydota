@extends('match.app')

@section('content')

	<div class="itemSecret">
	<h2>itemComponent</h2>
	@foreach($itemComponent as $key => $item)
    	<div>
    		<img src="{{$items->getImgUrlById($item->id)}}" alt="">
    	</div>
	@endforeach;
    </div>
    <div class="itemSecret">
    <h2>itemConsumable</h2>
	@foreach($itemConsumable as $k => $index)
    	<div>
    		<img src="{{$items->getImgUrlById($index->id)}}" alt="">
    	</div>
	@endforeach;
	</div>
    <div class="itemSecret">
    <h2>itemRare</h2>
	@foreach($itemRare as $kk => $index2)
    	<div>
    		<img src="{{$items->getImgUrlById($index2->id)}}" alt="">
    	</div>
	@endforeach;
    </div>
    <div class="itemSecret">
    <h2>itemEpic</h2>
	@foreach($itemEpic as $kkk => $index3)
    	<div>
    		<img src="{{$items->getImgUrlById($index3->id)}}" alt="">
    	</div>
	@endforeach;
    </div>
    <div class="itemSecret">
    <h2>itemArtifact</h2>
	@foreach($itemArtifact as $kkkk => $index4)
    	<div>
    		<img src="{{$items->getImgUrlById($index4->id)}}" alt="">
    	</div>
	@endforeach;
    </div>
    <div class="itemSecret">
    <h2>itemSecret</h2>
	@foreach($itemSecret as $kkkkk => $index5)
    	<div>
    		<img src="{{$items->getImgUrlById($index5->id)}}" alt="">
    	</div>
	@endforeach;
    </div>

@stop