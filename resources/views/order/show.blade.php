@extends('layouts.usertemplate')

@section('content')
    <table>
        <tr>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Voorraad</th>
            <th>Korting</th>
            <th></th>
            <th>Aantal</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($order->products as $product)
            <tr>
                <td><a>{{$product->name}}</a></td>
                <td><a>€{{$product->price}}</a></td>
                <td><a>{{$product->storage}}</a></td>
                <td><a>{{$product->pivot->amount}}</a></td>
                @if($order->status == 'active')
                    <td><a href="{{ action('OrderController@remove', [$product]) }}"><i class="fas fa-trash"></i></a></td>
                @endif
            </tr>
        @endforeach
    </table>
@endsection
