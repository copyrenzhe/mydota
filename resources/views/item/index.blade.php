@extends('layouts.app')
@section('styles')
	<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@stop
@section('content')
	<div class="itemSecret">
    <h2>消耗品</h2>
    <div class="shopHeaderImg">
        <img src="http://cdn.dota2.com.cn/apps/dota2/images/heropedia/itemcat_consumables.png" alt="" title="消耗品">
    </div>
	@foreach($itemConsumable as $k => $index)
    	<div>
    		<img src="{{$items->getImgUrlById($index->id)}}" alt="">
    	</div>
	@endforeach;
	</div>

	<div class="itemSecret">
	<h2>基础物品</h2>
	<div class="shopHeaderImg">
		<img src="http://cdn.dota2.com.cn/apps/dota2/images/heropedia/itemcat_armaments.png" alt="" title="基础物品">
	</div>
	@foreach($itemComponent as $key => $item)
    	<div>
    		<img src="{{$items->getImgUrlById($item->id)}}" alt="">
    	</div>
	@endforeach;
    </div>
    
    <div class="itemSecret">
    <h2>稀有</h2>
    <div class="shopHeaderImg">
    	<img src="http://cdn.dota2.com.cn/apps/dota2/images/heropedia/itemcat_support.png" alt="" title="稀有">
    </div>
	@foreach($itemRare as $kk => $index2)
    	<div>
    		<img src="{{$items->getImgUrlById($index2->id)}}" alt="">
    	</div>
	@endforeach;
    </div>
    <div class="itemSecret">
    <h2>史诗</h2>
    <div class="shopHeaderImg">
    	<img src="http://cdn.dota2.com.cn/apps/dota2/images/heropedia/itemcat_weapons.png" alt="" title="史诗">
    </div>
	@foreach($itemEpic as $kkk => $index3)
    	<div>
    		<img src="{{$items->getImgUrlById($index3->id)}}" alt="">
    	</div>
	@endforeach;
    </div>
    <div class="itemSecret">
    <h2>圣物</h2>
    <div class="shopHeaderImg">
    	<img src="http://cdn.dota2.com.cn/apps/dota2/images/heropedia/itemcat_artifacts.png" alt="" title="圣物">
    </div>
    
	@foreach($itemArtifact as $kkkk => $index4)
    	<div>
    		<img src="{{$items->getImgUrlById($index4->id)}}" alt="">
    	</div>
	@endforeach;
    </div>
    <div class="itemSecret">
    <h2>神秘商店</h2>
    <div class="shopHeaderImg">
    	<img src="http://cdn.dota2.com.cn/apps/dota2/images/heropedia/itemcat_secret.png" alt="" title="神秘商店">
    </div>
	@foreach($itemSecret as $kkkkk => $index5)
    	<div>
    		<img src="{{$items->getImgUrlById($index5->id)}}" alt="">
    	</div>
	@endforeach;
    </div>

@stop