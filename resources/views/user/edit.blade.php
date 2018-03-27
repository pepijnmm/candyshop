@extends('layouts.app')

@section('content')
<form action="{{ action('UserController@update',$user->id)   }}" method="POST">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
	<div class="row">
		<div class="six columns">
		  <label for="first_name">Voornaam</label>
		  <input required class="u-full-width" name="first_name" type="text" value="{{(empty(old('first_name')))?$user->first_name:old('first_name')}}">
		</div>
		<div class="six columns">
		  <label for="second_name">Tussenvoegsel en achternaam</label>
		  <input required class="u-full-width" name="second_name" type="text" value="{{(empty(old('second_name')))?$user->second_name:old('second_name')}}">
		</div>
	</div>
	<div class="row">
		<div class="six columns">
		  <label for="email">E-mail</label>
		  <input required class="u-full-width" name="email" type="text" value="{{(empty(old('email')))?$user->email:old('email')}}">
		</div>
		<div class="six columns">
		  <label for="phone_number">Telefoon-nummer*</label>
		  <input class="u-full-width" name="phone_number" type="text" value="{{(empty(old('phone_number')))?$user->phone_number:old('phone_number')}}">
		</div>
	</div>
	<div class="row">
		<div class="six columns">
		  <label for="role">Admin</label>
		  <input type="checkbox" name="role" {{(empty(old('role')))?$user->role:old('role') == true ?  'checked' : ''}}>
		</div>
	</div>
	<div class="row">
		<input class="button-primary" type="submit" value="Opslaan">
	</div>
</form>
<form action="{{ action('UserController@destroy',$user->id)   }}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
			<input class="button-primary" type="submit" value="Verwijderen">
</form>
@endsection