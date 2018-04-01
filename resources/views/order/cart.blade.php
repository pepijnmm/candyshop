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
                <td><a>{{$product->name}}</a></td>
                <td><a>€{{$product->price}}</a></td>
                <td><a>{{$product->storage}}</a></td>
                <td><a>{{$product->discount}}</a></td>
                <td><a>{{$product->pivot->amount}}</a></td>
                    <td><a href="#" onclick="event.preventDefault(); document.getElementById('send-form').submit();"><i class="fas fa-trash"></i></a></td>
                    <form id="send-form" action="{{ action('OrderController@remove', [$product]) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
            </tr>
        @endforeach
    </table>
    <h4>Totaal: {{$order->total_price}}</h4>
    <a href="{{action('OrderController@checkout')}}" class="button">Betalen</a>
@endsection
