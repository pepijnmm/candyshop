@extends('layouts.app')

@section('content')
<div class="row" id="product">
    <div class="two columns">
    </div>

	<div class="six columns" id="userinfo">
			<div id="leftinfo">
				<p>Voornaam:</p>
				<p>Tussenvoegsel en achternaam:</p>
				<p>E-mail:</p>
				<p>Telefoonnummer:</p>
				<p>Admin:</p>
				
			</div>
			<div id="rightinfo">
				<p>{{$user->first_name}}</p>
				<p>{{$user->second_name}} </p>
				<p>{{$user->email}} </p>
				<p>{{$user->phone_number}}&nbsp; </p>
				<p>{{($user->role>0)?'ja':'nee'}}</p>
			</div>
	</div>
	<div class="six columns">
		<br/>
	</div>
	<div class="row">
		<div class="six columns">
				<button onclick="location.href='{{action('UserController@edit',$user->id)}}'" type="button">Aanpassen</button>
				<form action="{{ action('UserController@passwordreset',$user->id)   }}" onSubmit="if(!confirm('Weet je het zekker?')){event.preventDefault();}" method="POST">
		            {{ method_field('PUT') }}
		            {{ csrf_field() }}
					<input class="button-primary" type="submit" value="Wachtwoord resetten">
				</form>
		</div>
	</div>
</div>
@endsection