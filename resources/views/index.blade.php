@extends('app')

@section('content')
<div class="container">
	<div class="header">
		<div class="current-count">当前在线玩家：{{$data['current_num']}}</div>
		<div class="search-box">
			<input type="text" name="search" class="search" placeholder="输入国服昵称或数字ID"><input class="index-search" type="button" value="搜索" onclick="js_search();">
		</div>
	</div>
</div>
@endsection
