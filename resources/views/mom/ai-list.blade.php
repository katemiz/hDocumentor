<section class="section container">

    <script src="{{ asset('/js/list.js') }}"></script>

    <div class="columns">
        <div class="column">

            <header class="mb-6">
                <h1 class="title has-text-weight-light is-size-1">AIs</h1>
                <h2 class="subtitle has-text-weight-light">List of Action Items</h2>
            </header>
        </div>

        <div class="column is-narrow">

            <a href="/ai-gui" class="button is-link">
                <span class="icon is-small">
                <x-heroicon-o-plus-circle />
                </span>
            </a>

        </div>
    </div>

    @if ($ais)
        <table class="table is-fullwidth">

            <caption>Total number of AIs <b>{{ $ais->total() }}</b> </caption>

            <x-table-head-row :columns="$columns" :hasaction="$has_actions" />

            <tbody>

                @foreach ($ais as $ai)
                <x-table-body-cell :item="$ai" :columns="$columns" :hasaction="$has_actions" :actions="$permitted_to"/>
                @endforeach

            </tbody>

        </table>

        {{ $ais->links()}}

    @else
        <div class="notification is-warning is-light">No MOM found</div>
    @endif



</section>
