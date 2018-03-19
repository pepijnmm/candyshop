@extends('layouts.default')

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
 <form action="{{ action('ProductController@create')   }}" method="GET">
            {{ method_field('GET') }}
            {{ csrf_field() }}
			<input class="button-primary" type="submit" value="Toevoegen">
</form>
@endsection