@extends('layouts.app')

@section('content')
<table>
  <tr>
    <th>Voornaam</th>
    <th>Tussenvoegsel en achternaam</th>
	<th>E-mail</th>
	<th>Telefoon-nummer</th>
	<th>Admin</th>
  </tr>
  @foreach ($users as $user)
	<tr>
    <td><a href="{{action('UserController@show',$user->id)}}">{{$user->first_name}}</a></td>
    <td><a href="{{action('UserController@show',$user->id)}}">{{$user->second_name}}</a></td>
	<td><a href="{{action('UserController@show',$user->id)}}">{{$user->email}}</a></td>
	<td><a href="{{action('UserController@show',$user->id)}}">{{$user->phone_number}}</a></td>
	<td><a href="{{action('UserController@show',$user->id)}}">{{($user->role == 1?'ja':'nee')}}</a></td>
  </tr>
  @endforeach
 </table>
			<input class="button-primary" type="button" value="Toevoegen" onclick="location.href='{{ action('UserController@create')   }}'">
@endsection