<html>
  <head>
      <link rel="stylesheet" type="text/css" href="/css/fontawesome-all.min.css">
      <link rel="stylesheet" type="text/css" href="/css/skeleton.css">
      <link rel="stylesheet" type="text/css" href="/css/removeDefaultBrowser.css">
      <link rel="stylesheet" type="text/css" href="/css/main.css">
      <script src="/javascript/jquery.min.js"></script>
      <script src="/javascript/main.js"></script>
      <title>Ye sweet shoppe</title>
  </head>
  <body>
    <div id="login">

    <form class="container form-horizontal" method="POST" action="{{ route('login') }}">
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
        <div class="five columns">
          <br />
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
