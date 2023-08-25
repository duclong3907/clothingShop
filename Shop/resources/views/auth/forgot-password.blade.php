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
				<h3>Forgot-password</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600" style="color:#1a9bfc; text-align: center; margin-top:20px">
                    {{ session('status') }}
                </div>
            @endif
			<div class="card-body" style="padding:20px 30px 30px 30px;">
                <form method="POST" action="{{ route('password.email') }}">
					@csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" :value="old('email')" required autofocus autocomplete="username"
							placeholder="Enter email">
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="d-flex justify-content-center" style="margin-top: 10px;">
						<input type="submit" value="Send" class="btn float-right btn_send">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Back to login?<a href="/login">Login</a>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endsection