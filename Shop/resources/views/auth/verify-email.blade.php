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
				<h3>Verify email</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
					<div class="input-group form-group">
                    <span style="color: skyblue;">Before continuing, could you verify your email address by clicking on the link we just emailed to you? 
                    If you didn't receive the email, we will gladly send you another.</span>
					</div>
					<div class="form-group login" style="margin-top: 10px;">
                        <form method="POST" action="{{ route('verification.send') }}">
                         @csrf
                            <input type="submit" value="Resend Verification Email" class="btn float-right btn_login">
                        </form>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <input type="submit" value="Logout" class="btn float-right btn_login">
                        </form>
					</div>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <input type="submit" value="Logout" style="border:none; background: transparent; padding:0; color:#1a9bfc;">
                </form>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endsection