
<section class="section container">

    <script src="{{ asset('/js/list.js') }}"></script>

    <div class="columns">
        <div class="column">

            <header class="mb-6">
                <h1 class="title has-text-weight-light is-size-1">Letters</h1>
                <h2 class="subtitle has-text-weight-light">Letters : Business, Private etc</h2>
            </header>
        </div>

        <div class="column is-narrow">

            <a href="/letter-gui" class="button is-link">
                <span class="icon is-small">
                <x-heroicon-o-plus-circle />
                </span>
            </a>

        </div>
    </div>



    @if ($letters)
        <table class="table is-fullwidth">

            <caption>Total number of letters <b>{{ $letters->total() }}</b> </caption>

            <x-table-head-row :columns="$columns" :hasaction="$has_actions" />

            <tbody>

                @foreach ($letters as $letter)
                <x-table-body-cell :item="$letter" :columns="$columns" :hasaction="$has_actions" :actions="$permitted_to"/>
                @endforeach

            </tbody>

        </table>

        {{ $letters->links()}}

    @else
        <div class="notification is-warning is-light">No letters found</div>
    @endif



</section>
