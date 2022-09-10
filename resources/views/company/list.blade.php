
<section class="section container">

    <script src="{{ asset('/js/list.js') }}"></script>

    <div class="columns">
        <div class="column">

            <header class="mb-6">
                <h1 class="title has-text-weight-light is-size-1">Companies</h1>
                <h2 class="subtitle has-text-weight-light">My Company and All Other Companies</h2>
            </header>
        </div>

        <div class="column is-narrow">

            <a href="/company-gui" class="button is-link">
                <span class="icon is-small">
                <x-heroicon-o-plus-circle />
                </span>
            </a>

        </div>
    </div>



    @if ($companies)
        <table class="table is-fullwidth">

            <caption>Total number of companies <b>{{ $companies->total() }}</b> </caption>

            <x-table-head-row :columns="$columns" :hasaction="$has_actions" />

            <tbody>

                @foreach ($companies as $company)
                <x-table-body-cell :letter="$company" :columns="$columns" :hasaction="$has_actions" :actions="$permitted_to"/>
                @endforeach

            </tbody>

        </table>

        {{ $companies->links()}}

    @else
        <div class="notification is-warning is-light">No companies found</div>
    @endif



</section>
