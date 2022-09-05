<x-app-layout>
    <section class="section container">

        @if ($company->notification)
        {{$company->notification->msg}}
        @endif

        <a href="/company-gui/{{$company->id}}">Edit</a>



        <header class="mb-6 has-background-light">

            <p class="has-text-grey mt-6 pb-6 px-1">kapkara mühendislik danışmanlık</p>



        </header>

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
        <div class="columns">

            <div class="column is-2">
                Subject
            </div>

            <div class="column">
                {{$letter->subject }}
            </div>
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



        <footer class="has-background-light">

            <p class="has-text-grey mt-6 pt-6 px-1">B{{$letter->id}}</p>
        </footer>


    </section>
</x-app-layout>

