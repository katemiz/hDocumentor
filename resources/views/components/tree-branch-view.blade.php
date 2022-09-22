<div>


    <div class="columns">
        <div class="column">
            <h1 class="title has-text-weight-light is-size-1">Chapter</h1>
        </div>

        <div class="column has-text-right">




                <a href="/ai-gui/{{$chapter->id}}">
                    <span class="icon is-small">
                        <x-heroicon-s-pencil class="has-text-link"/>
                    </span>
                </a>

                <a onclick="confirmDelete('{{$chapter->id}}','aitem')">
                    <span class="icon is-small">
                        <x-heroicon-s-trash class="has-text-danger"/>
                    </span>
                </a>

        </div>
    </div>



    <div class="column">
        <h2 class="subtitle has-text-grey is-size-6 mb-3">AI Description</h2>

        {{ $chapter->title }}
    </div>

    <div class="column">
        <h2 class="subtitle has-text-grey is-size-6 mb-3">AI Holder Company / Person and Due Date</h2>

        {!! $chapter->content !!}

    </div>

</div>
