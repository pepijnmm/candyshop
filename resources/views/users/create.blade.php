@extends('layouts.app')

@section('content')
<form method="POST" action="{{action('UserController@store')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ method_field('POST') }}
            {{ csrf_field() }}
	<div class="row">
		<div class="six columns">
		  <label for="first_name">Voornaam</label>
		  <input required class="u-full-width" name="first_name" type="text" value="{{old('first_name')}}">
		</div>
		<div class="six columns">
		  <label for="last_name">Tussenvoegsel en achternaam</label>
		  <input required class="u-full-width" name="last_name" type="text" value="{{old('last_name')}}">
		</div>
	</div>
	<div class="row">
		<div class="six columns">
		  <label for="email">E-mail</label>
		  <input required class="u-full-width" name="email" type="text" value="{{old('email')}}">
		</div>
		<div class="six columns">
		  <label for="phone_number">Telefoon-nummer*</label>
		  <input class="u-full-width" name="phone_number" type="text" value="{{old('phone_number')}}">
		</div>
	</div>
	<div class="row">
		<div class="six columns">
		  <label for="password">Wachtwoord</label>
		  <input required class="u-full-width" name="password" type="text" value="{{old('password')}}">
		</div>
		<div class="six columns">
		  <label for="role">Admin</label>
		  <input type="checkbox" name="role" {{old('role') == true ?  'checked' : ''}}>
		</div>
	</div>
	<div class="row">
		<input class="button-primary" type="submit" value="Opslaan">
	</div>
</form>
@endsection