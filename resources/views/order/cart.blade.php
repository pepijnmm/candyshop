@extends('layouts.default')

@section('content')
    <table>
        <tr>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Voorraad</th>
            <th>Korting</th>
            <th>Aantal</th>
        </tr>
        @foreach ($order->products as $product)
            <tr>
                <td><a href="{{ action('ProductController@show', $product->id) }}">{{$product->name}}</a></td>
                <td><a href="{{ action('ProductController@show', $product->id) }}">€{{$product->price}}</a></td>
                <td><a href="{{ action('ProductController@show', $product->id) }}">{{$product->storage}}</a></td>
                <td><a href="{{ action('ProductController@show', $product->id) }}">{{$product->discount}}</a></td>
                <td>
                    <a href="{{ action('OrderController@removeamount', [$order, $product]) }}"><i class="fas fa-minus"></i></a>
                    <a>{{$product->pivot->amount}}</a>
                    <a href="{{ action('OrderController@addamount', [$order, $product]) }}"><i class="fas fa-plus"></i></a>
                </td>
                    <td><a href="#" onclick="event.preventDefault(); document.getElementById('send-form').submit();"><i class="fas fa-trash"></i></a></td>
                    <form id="send-form" action="{{ action('OrderController@remove', [$product]) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
            </tr>
        @endforeach
    </table>
    <h4>Totaal: €{{round($order->total_price, 2)}}</h4>
    <a href="{{action('OrderController@checkout')}}" class="button">Betalen</a>
@endsection
