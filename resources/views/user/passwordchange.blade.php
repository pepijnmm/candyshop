@extends('layouts.usertemplate')

@section('content')
<form action="{{ action('UserController@storepasswordchange')   }}" method="POST">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
	<div class="row">
		<div class="six columns">
		  <label for="oldpassword">Oude wachtwoord</label>
		  <input required class="u-full-width" name="oldpassword" type="password">
		</div>
		<div class="six columns">
		  <label for="newpassword">Nieuw wachtwoord</label>
		  <input required class="u-full-width" name="newpassword" type="password">
		</div>
	</div>
	<div class="row">
		<div class="six columns">
		  <label for="secondnewpassword">Nog een keer het nieuwe wachtwoord</label>
		  <input required class="u-full-width" name="secondnewpassword" type="password">
		</div>
		<div class="six columns">
		  <input class="button-primary" type="submit" value="Opslaan">
		</div>
	</div>
</form>
@endsection