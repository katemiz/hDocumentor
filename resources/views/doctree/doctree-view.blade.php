<x-app-layout>

    <section class="section container" >

        <script src="{{ asset('/js/sweetalert2.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/css/sweetalert2_min.css') }}">
        <script src="{{ asset('/js/confirm.js') }}"></script>

        <div class="box">

        @if ($notification)
            {{$notification['msg']}}
        @endif

        <div class="columns">
            <div class="column">
                <h1 class="title has-text-weight-light is-size-1">Doc Tree</h1>
            </div>

            <div class="column has-text-right">

                <a href="/doctree-tree/{{$doctree->id}}">
                    <span class="icon is-small">
                        <x-heroicon-s-eye class="has-text-link"/>
                    </span>
                </a>

                <a href="/doctree-form/{{$doctree->id}}">
                    <span class="icon is-small">
                        <x-heroicon-s-pencil class="has-text-link"/>
                    </span>
                </a>

                <a onclick="confirmDelete('{{$doctree->id}}','doctree')">
                    <span class="icon is-small">
                        <x-heroicon-s-trash class="has-text-danger"/>
                    </span>
                </a>

            </div>
        </div>

        <div class="column">
            <h2 class="subtitle has-text-grey is-size-6 mb-3">Doc Tree Title</h2>
            {{ $doctree->title }}
        </div>

        <div class="column">
            <h2 class="subtitle has-text-grey is-size-6 mb-3">Doc Tree Details and Remarks</h2>
            {!! $doctree->remarks !!}
        </div>

        </div>

    </section>
</x-app-layout>
