@extends('layouts.usertemplate')

@section('content')
<table>
  <tr>
    <th>Straat</th>
    <th>Huisnummer</th>
    <th>Postcode</th>
  </tr>
  @foreach ($addresses as $address)
	<tr>
    <td><a href="{{action('AddressController@show',$address->id)}}">{{$address->street_name}}</a></td>
    <td><a href="{{action('AddressController@show',$address->id)}}">{{$address->house_number}}</a></td>
    <td><a href="{{action('AddressController@show',$address->id)}}">{{$address->zip_code}}</a></td>
  </tr>
  @endforeach
 </table>
			<input class="button-primary" type="button" value="Toevoegen" onclick="location.href='{{ action('AddressController@create')   }}'">
@endsection