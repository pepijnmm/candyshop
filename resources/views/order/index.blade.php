@extends('layouts.default')

@section('content')

    <div style="background: #a94442">
        >>>INDEX PAGE
        <?php
        echo ' (id: ' . \Illuminate\Support\Facades\Session::getId() . ')';
        ?>
        <<<
    </div>
@endsection
