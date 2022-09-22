<div class="box">






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


    <div class="column">
        <h1 class="title has-text-centered has-text-grey is-size-1 my-6">{{ $doctree->title }}</h1>
    </div>

    <div class="column has-text-centered mb-6">
        {!! $doctree->remarks !!}
    </div>




    <nav class="level">
        <!-- Left side -->
        <div class="level-left">
            {{$doctree->user_id}}
        </div>

        <!-- Right side -->
        <div class="level-right">
         {{$doctree->created_at}}
        </div>
      </nav>

</div>
