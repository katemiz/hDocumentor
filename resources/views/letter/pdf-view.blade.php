<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />

    <link  rel="icon" type="image/svg+xml" href="{{ asset(Config::get('constants.favicon')) }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link  href="{{ asset('/css/css.css') }}" rel="stylesheet" />
    <link  href="{{ asset('/css/bulma.css') }}" rel="stylesheet" />

    <style>


@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}
    </style>

  </head>
  <body>

    <section class="section container">




        <div class="column">


        <h1 class="title has-text-dark">kapkara mühendislik danışmanlık</h1>
        </div>


        <div class="column">

        <div class="columns">

            <div class="column is-half">
                BESTE SOK 2/2<br>
                ETLİK ANKARA<br>
                (90) 555 286 31 10<br>
                katemiz@gmail.com<br>
                https://kapkara.one<br>


            </div>

            <div class="column has-text-right">
                {!! QrCode::size(100)->generate(Request::url()); !!}
                <br>
                {{$letter->letterno}}
            </div>

        </div>
        </div>


        @if ($letter->toCompany)
        <div class="column">
            {{ $letter->toCompany }}
        </div>
        @endif

        @if ($letter->toPerson)
        <div class="column">
            {{ $letter->toPerson }}
        </div>
        @endif


        <div class="column has-text-info">
            {{$letter->tarih}}
        </div>


        @if ($letter->refarray)
        <div class="column content">

            References :
            <ol>
                @foreach ($letter->refarray as $ref)
                <li>{{$ref}}</li>
                @endforeach
            </ol>
            </div>
        </div>
        @endif


        @if ($letter->subject)
        <div class="column content">

            Subject
            <span class="has-text-weight-bold has-text-info">{{$letter->subject }}</span>
        </div>
        @endif

        <div class="column">
            {!! $letter->content !!}
        </div>


        @if ($letter->dosyalar)
        <div class="column">

            @foreach ($letter->dosyalar as $key => $dosya )
                <p>
                    <span class="has-text-weight-bold">Attach {{ ++$key }}</span>
                    <span class="has-text-weight-light">{{$dosya->filename }}</span>
                </p>
            @endforeach
        </div>
        @endif






    </section>

  </body>
</html>




