{{-- <div class="my-0"  {{$istop ? 'tree-root="reorder"':''}}>
    @foreach($branches as $k => $branch)
        <div class="ml-6 my-0" order="ORDER {{$k}}" tree-branch="{{$branch['id']}}" wire:key="{{$branch['id']}}" draggable="true">
            {{$branch['id']}} - {{$branch['content']}} ORDER {{$k}}
            @if($branch['children'])
                <x-tree-branch :branches="$branch['children']" istop="{{false}}" />
            @endif
        </div>
    @endforeach
</div> --}}


<ul class="">
    @foreach($branches as $k => $branch)
        <li
            class="nobullet"
            order="ORDER {{$k}}"
            tree-branch="{{$branch['id']}}"
            wire:key="{{$branch['id']}}"
            parentId="{{$branch['parent_id']}}"
            draggable="true">

            <span id="Span{{$branch['id']}}">
            {{$branch['id']}} - {{$branch['content']}} ORDER {{$k}}
            </span>
            @if($branch['children'])
                <x-tree-branch :branches="$branch['children']" />
            @endif
        </li>
    @endforeach
</ul>

