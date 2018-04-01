@extends('layouts.default')

@section('content')
    <div style="text-align: center; display: flex; flex-direction: column">
        <h2 style="align-self: center; ">Welkom bij Ye Sweet Shoppe!</h2>
        <img style="width: 500px; align-self: center; margin: 10px" src="images/{{ (!empty($products[0]))?$products[0]->image_location:''}}" alt="product plaatje"/>
        <div style="align-self: center; display: inline-flex; flex-direction: row; flex-wrap: nowrap; justify-content: center">
            <table style="padding: 10px; width: 400px">
                <caption>Ons assortiment:</caption>
                <tr>
                    <th></th>
                    <th>Naam</th>
                    <th>Prijs</th>
                    <th>Knop</th>
                </tr>
                @foreach ($products as $product)
                    <tr>
                        <td><img src="/images/{{$product->image_location}}" class="categoryproductpicture" alt="product plaatje"/></td>
                        <td><a href="{{ action('ProductController@show', $product->id) }}">{{$product->name}}</a></td>
                        <td><a href="{{ action('ProductController@show', $product->id) }}">€{{$product->price}}</a></td>
                        <td><a href="#" class="button" onclick="event.preventDefault(); document.getElementById('buy-product{{$product->id}}').submit();" >kopen</a></td>
                            <form id="buy-product{{$product->id}}" action="{{ action('OrderController@add',$product->id) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                <input type="number" name="amount" value="1" style="display: none;">
                            </form>
                    </tr>
                @endforeach
            </table>
            <table style="padding: 10px; width: 400px">
                <caption>Onze aanbiedingen:</caption>
                <tr>
                    <th></th>
                    <th>Naam</th>
                    <th>Prijs</th>
                    <th>Korting</th>
                </tr>
                @foreach ($products->where('discount', '<>', null) as $product)
                    <tr>
                        <td><img src="/images/{{$product->image_location}}" class="categoryproductpicture" alt="product plaatje"/></td>
                        <td><a href="{{ action('ProductController@show', $product->id) }}">{{$product->name}}</a></td>
                        <td><a href="{{ action('ProductController@show', $product->id) }}">€{{$product->price}}</a></td>
                        <td><a href="{{ action('ProductController@show', $product->id) }}">{{$product->discount}}%</a></td>
                        <td><a href="#" class="button" onclick="event.preventDefault(); document.getElementById('buy-product{{$product->id}}').submit();" >kopen</a></td>
                        <form id="buy-product{{$product->id}}" action="{{ action('OrderController@add',$product->id) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            <input type="number" name="amount" value="1" style="display: none;">
                        </form>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection