@extends('layouts.default')

@section('content')
    <div>
    
        @if(!empty($category->image_location))<img class="categorypicture" src="/images/{{$category->image_location}}" alt="categorie plaatje"/>@endif
        @if(!empty($category->name))<h2>{{$category->name}}</h2>@endif
    </div>
    @if($products->count()==0)
        <p>Sorry er zijn geen producten in deze categorie</p>
    @else<table>
        <tr>
            <th>picture</th>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Korting</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td><img src="/images/{{$product->image_location}}" class="categoryproductpicture" alt="product plaatje"/></td>
                <td><a href="{{ action('ProductController@show', $product) }}">{{$product->name}}</a></td>
                <td><a href="{{ action('ProductController@show', $product) }}">€{{$product->price}}</a></td>
                <td><a href="{{ action('ProductController@show', $product) }}">{{$product->discount}}%</a></td>
            </tr>
        @endforeach
    </table>
    @endif
@endsection