<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link  rel="icon" type="image/svg+xml" href="{{ asset(Config::get('constants.favicon')) }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ Config::get('constants.app.title') }}</title>

        <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">
        <link rel="stylesheet" href="{{ asset('css/log.css') }}">
    </head>


    <body>
        <section class="section container is-max-desktop">

            <div class="column is-half is-offset-one-quarter">

                <nav class="breadcrumb has-bullet-separator is-right" aria-label="breadcrumbs">
                    <ul>
                        <li class="{{ app()->getLocale() == 'tr' ? 'is-active':''}}">
                        <a href="{{ route('lang.switch', 'tr') }}">TR</a>
                    </li>
                    <li class="{{ app()->getLocale() == 'en' ? 'is-active':''}}">
                        <a href="{{ route('lang.switch', 'en') }}">EN</a>
                    </li>
                    </ul>
                </nav>

            </div>

            <div class="column is-half is-offset-one-quarter has-background-white">

                <div class="column is-offset-3 is-offset-4-mobile is-6 is-4-mobile my-6">
                    <figure class="image">
                        <img src="/images/{{config('constants.app.app_login_logo')}}" alt="{{config('constants.app.name')}}">
                    </figure>
                </div>

                {{$slot}}

            </div>

            <div class="column is-half is-offset-one-quarter">

                <div class="columns">

                    <div class="column is-half has-text-centered-mobile">
                        <a href="{{config('constants.company.link')}}">
                            <img src="/images/{{config('constants.company.logo')}}" width="24px" alt="{{config('constants.company.name')}}">
                        </a>
                    </div>

                    <div class="column is-offset-one-quarter has-text-right has-text-centered-mobile">
                        <a href="{{config('constants.company.link')}}">{{config('constants.company.name')}}</a>
                    </div>
                </div>

            </div>

        </section>
    </body>
</html>
