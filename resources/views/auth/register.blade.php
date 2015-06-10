@extends('app')

@section('content')
<div class="container">
	<div class="register">
		<h2 class="mb10 tc">注册MyDotA</h2>
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

			<form class="form" role="form" method="POST" action="{{ url('/auth/register') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">

					<label class="form-label">昵称：</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="glyphicon glyphicon-user">
			                </i>
						</div>
						<input type="text" class="form-control" name="name" value="{{ old('name') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="form-label">邮箱：</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="glyphicon glyphicon-envelope">
			                </i>
						</div>
						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
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
					<label class="form-label">密码确认：</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="glyphicon glyphicon-lock">
			                </i>
						</div>
						<input type="password" class="form-control" name="password_confirmation">
					</div>
				</div>

				<div class="form-group">
					<div class="form-box">
						<button type="submit" class="btn btn-primary width-100">
							注册
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
