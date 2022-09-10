<div class="column">

    <div class="columns">

        <div class="column is-3">

            @if ($letter->sender->logos)

                @foreach ($letter->sender->logos as $logo)
                    <img src="{{$logo->imgEncode($logo->stored_as)}}" />
                @endforeach

            @endif

        </div>

        <div class="column">
            <h1 class="title has-text-weight-light has-text-right">
            {{$letter->sender->fullname}}
            </h1>
        </div>

    </div>

</div>

<div class="column">
    <div class="columns">

        <div class="column is-half">
            <address>{!!$letter->sender->address!!}</address>
            <ul>
                <li>{{$letter->sender->phone}}</li>
                <li><a href="mailto:{{$letter->sender->email}}">{{$letter->sender->email}}</a></li>
                <li><a href="{{$letter->sender->website}}">{{$letter->sender->website}}</a></li>
            </ul>
        </div>

        <div class="column has-text-right">
            {!! QrCode::size(100)->generate(Request::url()); !!}
            <br>
            @if ($letter->status == 'signed')
                {{$letter->letterno}}
            @else
                {{strtoupper($letter->status)}}
            @endif
        </div>

    </div>
</div>

@if ($letter->toCompany)
<div class="column">
    @if ($letter->toCompany)
        {{ $letter->toCompany }}
    @endif

    @if ($letter->toPerson)
        <br>{{ $letter->toPerson }}
    @endif
</div>
@endif

<div class="column has-text-info">
    {{$letter->tarih}}
</div>

@if ($letter->refarray)
<div class="column content">
    {{__('References')}}:
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
    {{__('Subject')}}:
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
            <span class="has-text-weight-bold">{{__('Attach')}} {{ ++$key }}</span>
            <span class="has-text-weight-light">{{$dosya->filename }}</span>
        </p>
    @endforeach
</div>
@endif

<div class="column mt-6">
    @if ($letter->status == 'signed')
        {{$letter->letterno}}
    @else
        {{strtoupper($letter->status)}}
    @endif
</div>
