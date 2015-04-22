@extends('app')
<style type="text/css">
	.container .search-box{
		width: 500px;
		margin: 150px auto;
	}

	.container .search-box .search{
		width: 400px;
		padding: 9px 7px;
		font: 16px arial;
		float: left;
	}

	.container .search-box .index-search{
		line-height: 40px;
		background-color: #38f;
		padding: 0px;
		border: 0;
		width: 100px;
		color: white;
		font-size: 16px;
	}

</style>


@section('content')
<div class="container">
	<div class="header">
		<form action="{{ url('/search') }}" method="GET">
			<div class="search-box">
				<input type="text" name="search" class="search" placeholder="输入国服昵称或数字ID"><input class="index-search" type="submit" value="搜索">
			</div>
		</form>
	</div>
</div>
@endsection
