<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="/css/skeleton.css">
    <link rel="stylesheet" type="text/css" href="/css/removeDefaultBrowser.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/adminMain.css">
    <script src="/javascript/jquery.min.js"></script>
    <script src="/javascript/main.js"></script>
    <!-- Styles -->
</head>
<body id="adminpanel">
<div id="empty"></div>
<header class="row">
    <nav class="twelf columns">
        <div id="topheader">
            <div class="ten columns">
                <br/>
            </div>
            <div id="rightbuttons" class="two columns">
                <div id="userhover">
                @if(Auth::guest()) 
                <a href="{{ action('Auth\LoginController@showLoginForm') }}">
                @endif
                    <i class="fas fa-user" ></i>
                    @if (Auth::guest())
                    </a>
                    @else
                    <div id="usermenu">
                        <ul>
                            <li><a href="{{action('UserController@showcurrent')}}" >account</a></li>
                            <li><a href="{{action('OrderController@index')}}" >orders</a></li>
                            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >uitloggen</a></li>
                            <form id="logout-form" action="{{ action('Auth\LoginController@logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <li><a href="/" >webshop</a></li>
                            @if(Auth::user()->role == 1)
                                <li><a href="/admin" >adminpanel</a></li>
                            @endif
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>
<div class="row" id="main">
    <div class="four columns">
        <menu id="firstmenu">
            <menuitem class="parentmenuitem">
                Gebruiker instellingen
                <menu class="childmenu">
                    <menuitem>
                    <a href="{{action('UserController@showcurrent')}}">account</a>
                    </menuitem>
                    <menuitem>
                    <a href="{{action('UserController@useredit')}}">Aanpassen</a>
                    </menuitem>
                    <menuitem>
                    <a href="{{action('UserController@passwordchange')}}">Wachtwoord aanpassen</a>
                    </menuitem>

                </menu>
            </menuitem>
            <menuitem class="parentmenuitem">
                Bestellingen
                <menu class="childmenu">
                    <menuitem>
                    <a href="{{action('OrderController@index')}}">Alle bestellingen</a>
                    </menuitem>

                </menu>
            </menuitem>
            <menuitem class="parentmenuitem">
                Adress instellingen
                <menu class="childmenu">
                    <menuitem>
                    <a href="{{action('AddressController@index')}}">Alle addressen</a>
                    </menuitem>
                    <menuitem>
                    <a href="{{action('AddressController@create')}}">Toevoegen</a>
                    </menuitem>

                </menu>
            </menuitem>
        </menu>
    </div>
    <div class="seven columns">
        <main id="body" class="row">
        @if(!empty(Session::get('alert-success')))
            <div class="alert alert-success">{{Session::pull('alert-success')}}</div>
        @endif
        @if(!empty(Session::get('alert-info')))
            <div class="alert alert-info">{{Session::pull('alert-info')}}</div>
        @endif
        @if(!empty(Session::get('alert-warning')))
            <div class="alert alert-warning">{{Session::pull('alert-warning')}}</div>
        @endif
        @if(!empty(Session::get('alert-error')))
            <div class="alert alert-error">{{Session::pull('alert-error')}}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-error">Errors:
            <ul>
                @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif
        <div id="breadcrumb">
            @php
                $savedir = "";
            @endphp

            @foreach(array_filter(explode('/',$_SERVER['REQUEST_URI'])) as $dir)
            @if(!empty($savedir))<span> > </span>@endif
            <a href="{{$savedir .= '/'.$dir}}">{{$dir}}</a>

            @endforeach
        </div>
                @yield('content')
        </main>
    </div>
</div>
</body>
</html>
