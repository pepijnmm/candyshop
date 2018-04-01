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
                </tr>
                @foreach ($products as $product)
                    <tr>
                        <td><img src="/images/{{$product->image_location}}" class="categoryproductpicture" alt="product plaatje"/></td>
                        <td><a href="{{ action('ProductController@show', $product) }}">{{$product->name}}</a></td>
                        <td><a href="{{ action('ProductController@show', $product) }}">€{{$product->price}}</a></td>
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
                        <td><a href="{{ action('ProductController@show', $product) }}">{{$product->name}}</a></td>
                        <td><a href="{{ action('ProductController@show', $product) }}">€{{$product->price}}</a></td>
                        <td><a href="{{ action('ProductController@show', $product) }}">{{$product->discount}}%</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection