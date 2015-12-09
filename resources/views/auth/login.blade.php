@extends('layouts.default')
@section('styles')
	<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@stop
@section('content')
<div class="container">
	<div class="login account-box">
		<h2 class="mb10 tc">登录</h2>
		<hr class="mb10">
		<div class="panel-body">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<form class="form" role="form" method="POST" action="{{ url('/auth/login') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="form-label">邮箱：</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="glyphicon glyphicon-envelope">
			                </i>
						</div>
						<input type="text" class="form-control" name="email" value="{{ old('email') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="form-label">密码：</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="glyphicon glyphicon-lock">
			                </i>
						</div>
						<input type="password" class="form-control" name="password">
					</div>
				</div>

				<div class="form-group">
                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> 记住我
                            </label>
                        </div>
                    </div>
                </div>

				<div class="form-group">
					<div class="form-box">
						<button type="submit" class="btn btn-primary width-100">
							登录
						</button>
						<a class="btn btn-link" href="{{ url('/password/email') }}">忘记密码？</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
