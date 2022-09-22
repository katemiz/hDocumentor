<section class="section container">

    <script src="{{ asset('/js/list.js') }}"></script>

    <div class="columns">
        <div class="column">
            <header class="mb-6">
                <h1 class="title has-text-weight-light is-size-1">Structured Documentations</h1>
                <h2 class="subtitle has-text-weight-light">List of Documentation with Tree Structure</h2>
            </header>
        </div>

        <div class="column is-narrow">
            <a href="/doctree-form" class="button is-link">
                <span class="icon is-small"><x-heroicon-o-plus-circle /></span>
            </a>
        </div>
    </div>

    @if ($notification)
        <x-notification :notification="$notification" />
    @endif

    @if ($doctrees->total() > 0)

        <table class="table is-fullwidth">

            <caption>Total number of Doc Trees <b>{{ $doctrees->total() }}</b> </caption>

            <x-table-head-row :columns="$columns" :hasaction="$has_actions" />

            <tbody>

                @foreach ($doctrees as $doctree)
                <x-table-body-cell :item="$doctrees" :columns="$columns" :hasaction="$has_actions" :actions="$permitted_to"/>
                @endforeach

            </tbody>

        </table>

        {{ $doctrees->links()}}

    @else
        <div class="notification is-warning is-light">No Structured Documentation found</div>
    @endif

</section>
