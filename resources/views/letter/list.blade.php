
<section class="section container">





    <header class="my-6">
        <h1 class="title has-text-weight-light is-size-1">Letters</h1>
        <h2 class="subtitle has-text-weight-light">Letters : Business, Private etc</h2>
    </header>







    @if ($letters)

    <table class="table is-fullwidth">

        {{-- <caption>Toplam <b>{{ $letters->total() }}</b> kayıt vardır</caption> --}}

        <x-table-head-row :columns="$columns" :hasaction="$has_actions" />



        <tbody>

            @foreach ($letters as $letter)

            <x-table-body-cell :letter="$letter" :columns="$columns" :hasaction="$has_actions" :actions="$permitted_to"/>



            @endforeach

        </tbody>

    </table>

    {{ $letters->links()}}

@else
    <div class="notification is-warning is-light">No letters found</div>
@endif

</section>
