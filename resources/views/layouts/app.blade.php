<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />

    <link  rel="icon" type="image/svg+xml" href="{{ asset(Config::get('constants.favicon')) }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    {{-- <link  href="{{ asset('/css/app.css') }}" rel="stylesheet" /> --}}
    <link  href="{{ asset('/css/css.css') }}" rel="stylesheet" />

    <link  href="{{ asset('/css/bulma.css') }}" rel="stylesheet" />

    @livewireStyles

  </head>
  <body>

    @include('layouts.navigation',["user"=>false])

    {{ $slot }}

    @include('layouts.footer')

    @livewireScripts

  </body>
</html>
