@extends('layouts.default')

@section('content')

    <div style="background: #a94442">
        >>>SHOW PAGE
        <?php
            echo ' (id: ' . $order->id . ')';
        ?>
        <<<
    </div>
@endsection
