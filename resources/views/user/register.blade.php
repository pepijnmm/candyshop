@extends('layouts.loginregister')
@section('content')
    <div id="login">
		<form method="POST" action="{{action('UserController@userstore')}}" accept-charset="UTF-8" enctype="multipart/form-data">
					{{ method_field('POST') }}
					{{ csrf_field() }}
			<div class="row">
				<div class="six columns">
				  <label for="first_name">Voornaam</label>
				  <input required class="u-full-width" name="first_name" type="text" value="{{old('first_name')}}">
				</div>
				<div class="six columns">
				  <label for="second_name">Tussenvoegsel en achternaam</label>
				  <input required class="u-full-width" name="second_name" type="text" value="{{old('second_name')}}">
				</div>
			</div>
			<div class="row">
				<div class="six columns">
				  <label for="email">E-mail</label>
				  <input required class="u-full-width" name="email" type="email" value="{{old('email')}}">
				</div>
				<div class="six columns">
				  <label for="phone_number">Telefoon-nummer*</label>
				  <input class="u-full-width" name="phone_number" type="text" value="{{old('phone_number')}}">
				</div>
			</div>
			<div class="row">
				<div class="six columns">
				  <label for="password">Wachtwoord</label>
				  <input required class="u-full-width" name="password" type="password" value="{{old('password')}}">
				</div>
			</div>
			<div class="row secondrow">
				<div class="six columns">
				  <button onclick="location.href='{{route('login')}}'" type="button">Naar login</button>
				</div>
				<div class="six columns">
				  <input class="button-primary" type="submit" value="registreren">
				</div>
			</div>
		</form>
    </div>
@endsection