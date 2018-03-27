@extends('layouts.loginregister')
@section('content')
    <div id="login">

    <form class="container form-horizontal" method="POST" action="{{ action('Auth\LoginController@login') }}">
    	{{ csrf_field() }}
      <div class="row">
        <div class="five columns">
          <label for="email">Email</label>
          <input class="u-full-width" type="text" placeholder="email" value="{{ old('email') }}" name="email" required autofocus>
        </div>
        <div class="five columns">
          <label for="password">Wachtwoord</label>
          <input class="u-full-width" type="password" placeholder="Password" name="password">
        </div>
      </div>
      <div class="row secondrow">
        <div class="seven columns">
          <button onclick="location.href='{{action('UserController@register')}}'" type="button">Naar register</button>
        </div>
        <div class="five columns">
          <input class="button-primary" type="submit" value="Login">
        </div>
      </div>
      </div>
    </form>
    </div>
  </body>
</html>
@endsection