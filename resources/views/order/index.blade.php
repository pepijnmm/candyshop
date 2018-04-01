@extends('layouts.usertemplate')

@section('content')
    <table>
        <tr>
            <th>Datum</th>
            <th>Prijs</th>
            <th>Status</th>
            <th>Track code</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td><a>{{$order->updated_at}}</a></td>
                <td><a>€{{$order->total_price}}</a>
                <td><a>{{$order->status}}</a></td>
                <td><a>{{$order->track_code}}</a></td>
                <td><a href="{{ action('OrderController@show', $order) }}"><i class="fas fa-eye"></i></a></td>
            </tr>
        @endforeach
    </table>
@endsection