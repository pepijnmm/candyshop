@extends('layouts.app')

@section('content')
<table>
  <tr>
    <th>Naam</th>
    <th>Prijs</th>
	<th>Voorraad</th>
	<th>Korting</th>
  </tr>
  @foreach ($products as $product)
	<tr>
    <td><a href="{{action('ProductController@edit',$product->id)}}">{{$product->name}}</a></td>
    <td><a href="{{action('ProductController@edit',$product->id)}}">€{{$product->price}}</a></td>
	<td><a href="{{action('ProductController@edit',$product->id)}}">{{$product->storage}}</a></td>
	<td><a href="{{action('ProductController@edit',$product->id)}}">{{$product->discount}}</a></td>
  </tr>
  @endforeach
 </table>
			<input class="button-primary" type="button" value="Toevoegen" onclick="location.href='{{ action('ProductController@create')   }}'">
@endsection