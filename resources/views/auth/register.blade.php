@extends('app')

@section('content')
<div class="container">
	<div class="register">
		<div class="panel-heading">Register</div>
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

			<form class="form-inline" role="form" method="POST" action="{{ url('/auth/register') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="form-label">姓名</label>
					<div class="form-box">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						<input type="text" class="form-control" name="name" value="{{ old('name') }}">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
				    <div class="input-group">
				      <div class="input-group-addon">$</div>
				      <input type="text" class="form-control" id="exampleInputAmount" placeholder="Amount">
				      <div class="input-group-addon">.00</div>
				    </div>
			    </div>
				<div class="form-group">
					<label class="form-label">邮箱</label>
					<div class="form-box">
						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="form-label">密码</label>
					<div class="form-box">
						<input type="password" class="form-control" name="password">
					</div>
				</div>

				<div class="form-group">
					<label class="form-label">密码确认</label>
					<div class="form-box">
						<input type="password" class="form-control" name="password_confirmation">
					</div>
				</div>

				<div class="form-group">
					<div class="form-box">
						<button type="submit" class="btn btn-primary">
							注册
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
