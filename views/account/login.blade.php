@extends('layouts.page-layout')
@section('title', 'Login')
@section('main')
<div class="login">
	<h3>Login</h3>
	<form action="post-login" method="post">
		<div>
			<label for='username'>Username</label>
			<input name="username" id='username' @isset($username) value="{{$username}}" @endisset>
			
			@isset($errors['username'])
			<ul class="error">
				@foreach ($errors['username'] as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
			@endisset
		</div>
		<div>
			<label for='password'>Password</label>
			<input name="password" type="password" id='password' @isset($password) value="{{$password}}" @endisset>
			
			@isset($errors['password'])
			<ul class="error">
				@foreach ($errors['password'] as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
			@endisset
		</div>
		<p>
			<button type="submit">Login</button>
		</p>
		<p><?= $_GET['error'] ?? "" ?></p>
	</form>
</div>
@endsection