@extends('layouts.default')

@section('content')
    <table>
        <tr>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Voorraad</th>
            <th>Korting</th>
        </tr>
        @foreach ($category->products as $product)
            <tr>
                <td><a>{{$product->name}}</a></td>
                <td><a>€{{$product->price}}</a></td>
                <td><a>{{$product->storage}}</a></td>
                <td><a>{{$product->discount}}</a></td>
                <td><a href="{{ action('ProductController@show', $product) }}"><i class="fas fa-eye"></i></a></td>
            </tr>
        @endforeach
    </table>
@endsection