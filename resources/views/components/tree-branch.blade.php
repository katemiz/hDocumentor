@if ($istop)
<div class="{{$istop ? '':'ml-4'}}" {{$istop ? 'tree-root':''}} >
@endif

    @foreach($branches as $k => $branch)
        <div
            class="ml-4"
            tree-branch="{{$branch['id']}}"
            wire:key="{{$branch['id']}}"
            parent={{$parent}}
            draggable="true">

            <span id="Icons{{$branch['id']}}" >
                <span class="icon is-small" id="A{{$branch['id']}}"><a onclick="toggleBranch('{{$branch['id']}}')"><x-heroicon-o-chevron-right class="has-text-link"/></a></span>
                <span class="icon is-small" id="B{{$branch['id']}}"><a onclick="toggleBranch('{{$branch['id']}}')"><x-heroicon-o-chevron-down class="has-text-link"/></a></span>
                <span class="icon is-small" id="C{{$branch['id']}}"><x-heroicon-o-minus class="has-text-info"/></span>
            <span>

            <span>
                {{$branch['id']}} - <a href="#" draggable="false">{{$branch['content']}}</a> ORDER {{$k}}
            </span>

            @if($branch['children'])
                <x-tree-branch :branches="$branch['children']" istop="{{false}}" parent="{{$branch['id']}}"/>
            @endif
        </div>
    @endforeach

@if ($istop)
</div>
@endif

