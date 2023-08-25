@php
$title = "Login";
@endphp

@extends('layouts.master-auth')

@section('css')
@include('auth.css')
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