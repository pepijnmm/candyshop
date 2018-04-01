@extends('layouts.default')

@section('content')
    <div>
    
        @if(!empty($category->image_location))<img class="categorypicture" src="/images/{{$category->image_location}}" alt="categorie plaatje"/>@endif
        <h2>{{$category->name}}</h2>
    </div>
    @if($category->products->count()==0)
        <p>Sorry er zijn geen producten in deze categorie</p>
    @else<table>
        <tr>
            <th>picture</th>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Korting</th>
            <th>knop</th>
        </tr>
        @foreach ($category->products as $product)
            <tr>
                <td><img src="/images/{{$product->image_location}}" class="categoryproductpicture" alt="product plaatje"/></td>
                <td><a href="{{ action('ProductController@show', $product->id) }}">{{$product->name}}</a></td>
                <td><a href="{{ action('ProductController@show', $product->id) }}">€{{$product->price}}</a></td>
                <td><a href="{{ action('ProductController@show', $product->id) }}">{{$product->discount}}%</a></td>
                <td><a href="#" class="button" onclick="event.preventDefault(); document.getElementById('buy-product{{$product->id}}').submit();" >kopen</a></td>
                <form id="buy-product{{(empty($product))?'':$product->id}}" action="{{ action('OrderController@add',((empty($product))?0:$product->id)) }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    <input type="number" name="amount" value="1" style="display: none;">
                </form>
            </tr>
        @endforeach
    </table>
    @endif
@endsection