<x-app-layout>

    <section class="section container" >

        <script src="{{ asset('/js/sweetalert2.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/css/sweetalert2_min.css') }}">
        <script src="{{ asset('/js/confirm.js') }}"></script>

        @if ($notification)
            {{$notification['msg']}}
        @endif


        <div class="columns">
            <div class="column">
                <h1 class="title has-text-weight-light is-size-1">Action Item (AI)</h1>
                @if ($aitem->mom_id != null)
                <h2 class="subtitle has-text-weight-light">This Action Items Belongs to MOM-{{$aitem->mom_id}}</h2>
                @endif
            </div>

            <div class="column has-text-right">

                @if ($aitem->status == 'signed')

                    <span class="tag is-success">
                        {{strtoupper($aitem->status)}}
                        <span class="icon is-small ml-3">
                            <x-heroicon-o-check/>
                        </span>
                    </span>

                @else

                    <a href="/ai-gui/{{$aitem->id}}">
                        <span class="icon is-small">
                            <x-heroicon-s-pencil class="has-text-link"/>
                        </span>
                    </a>

                    <a onclick="confirmDelete('{{$aitem->id}}','aitem')">
                        <span class="icon is-small">
                            <x-heroicon-s-trash class="has-text-danger"/>
                        </span>
                    </a>

                @endif



            </div>
        </div>











        <div class="column">
            <h2 class="subtitle has-text-grey is-size-6 mb-3">AI Description</h2>

            {!! $aitem->description !!}
        </div>

        <div class="column">
            <h2 class="subtitle has-text-grey is-size-6 mb-3">AI Holder Company / Person and Due Date</h2>

            {{ $aitem->resp_company }}
            {{ $aitem->resp_person }}
            {{ $aitem->duedate }}

        </div>

        @if ($aitem->dosyalar)
        <div class="column">

            <h2 class="subtitle has-text-grey is-size-6 mb-3">AI Attachments</h1>

            @foreach ($aitem->dosyalar as $key => $dosya )
                <p>
                    <span class="has-text-weight-bold">{{__('Attach')}} {{ ++$key }}</span>
                    <span class="has-text-weight-light">{{$dosya->filename }}</span>
                </p>
            @endforeach
        </div>
        @endif
























    </section>
</x-app-layout>

