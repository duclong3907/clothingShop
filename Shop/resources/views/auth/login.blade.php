@php
$title = "Login";
@endphp

@extends('layouts.master-auth')

@section('css')
<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Numans');

	html,
	body {
		background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');
		background-size: cover;
		background-repeat: no-repeat;
		height: 100%;
		font-family: 'Numans', sans-serif;
	}

	.container {
		height: 100%;
		align-content: center;
	}

	.card {
		/* height: 370px; */
		margin-top: auto;
		margin-bottom: auto;
		width: 400px;
		background-color: rgba(0, 0, 0, 0.5) !important;
	}

	.social_icon span {
		font-size: 60px;
		margin-left: 10px;
		color: #FFC312;
	}

	.social_icon span:hover {
		color: white;
		cursor: pointer;
	}

	.card-header h3 {
		color: white;
	}

	.social_icon {
		position: absolute;
		right: 20px;
		top: -45px;
	}

	.input-group-prepend span {
		width: 50px;
		background-color: #FFC312;
		color: black;
		border: 0 !important;
	}

	input:focus {
		outline: 0 0 0 0 !important;
		box-shadow: 0 0 0 0 !important;

	}

	.remember {
		color: white;
	}

	.remember input {
		width: 20px;
		height: 20px;
		margin-left: 15px;
		margin-right: 5px;
	}

	.login_btn {
		color: black;
		background-color: #FFC312;
		width: 100px;
		display: block;
		margin-left: auto;
	}

	.login_btn:hover {
		color: black;
		background-color: white;
	}

	.links {
		color: white;
	}

	.links a {
		margin-left: 4px;
	}

	.login {
		display: flex;
		align-items: center;
		justify-content: space-between;
	}

	.btnGoogle {
		background-color: skyblue;
		padding: 5px 8px 5px 0;
	}

	@media(max-width:400px) {

		.login_btn {
			width: auto;
			font-size: 0.7rem;
		}

		.loginWord {
			font-size: 0.7rem;
		}
	}

	@media(max-width:300px) {
		.login {
			display: block;
			text-align: center;
		}

		.login_btn {
			margin: 10px auto;
			width: 150px;
		}

		.loginWord {
			font-size: 0.75rem;
		}

		.btnGoogle {
			background-color: skyblue;
			padding: 7px 5px 7px 0;
			width: 150px;
		}
	}
</style>
@stop

@section('content')
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form method="POST" action="{{ route('login') }}">
					@csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
							name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
							placeholder="username">
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input id="password" type="password"
							class="form-control @error('password') is-invalid @enderror" name="password" required
							autocomplete="current-password" placeholder="password">
						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="row align-items-center remember">
						<input class="form-check-input" type="checkbox">Remember Me
					</div>
					<div class="form-group login" style="margin-top: 10px;">
						<a href="{{url('auth/google')}}" class="btnGoogle">
							<span style="background: white; padding:7px;"><i class="bi bi-google"></i></span>
							<span style="color:white;" class="loginWord">Login with google</span></a>
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="/register">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					@if (Route::has('password.request'))
					<a href="{{ route('password.request') }}">Forgot your password?</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endsection