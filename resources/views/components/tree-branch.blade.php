@foreach($tree as $key => $branch_arr)

    @php
    foreach ($chapters as $key => $arr) {

        if ($arr['id'] == $branch_arr['id']) {
            $chapter = $arr;
            break;
        }

    }
    @endphp

    <div
    class="ml-4"
    tree-branch="{{$branch_arr['id']}}"
    wire:key="{{$branch_arr['id']}}"
    parent="{{ $chapter['parent_id']}}"
    draggable="true">

        <span id="Icons{{$branch_arr['id']}}" draggable="false">
            @isset($branch_arr['children'])
                <span class="icon is-small"  id="A{{$branch_arr['id']}}">
                    <a onclick="toggleBranch('{{$branch_arr['id']}}')">
                        <x-heroicon-o-chevron-right class="has-text-link"/>
                    </a>
                </span>
                <span class="icon is-small" id="B{{$branch_arr['id']}}">
                    <a onclick="toggleBranch('{{$branch_arr['id']}}')">
                        <x-heroicon-o-chevron-down class="has-text-link"/>
                    </a>
                </span>
            @else
                <span class="icon is-small" id="C{{$branch_arr['id']}}">
                    <x-heroicon-o-minus class="has-text-info"/>
                </span>
            @endisset
        </span>

        <span id="Text{{$branch_arr['id']}}" draggable="false">
            @foreach ($chapters as $chapter)
                @if ($chapter['id'] === $branch_arr['id'])
                    {{$chapter['id']}}-{{$chapter['title']}} <a href="#" draggable="false">{{$chapter['title']}}</a>
                @endif
            @endforeach
        </span>

        <span class="icon is-small ">
            <a onclick="triggerAdd({{$branch_arr['id']}})">
                <x-heroicon-o-plus-circle class="has-text-link"/>
            </a>
        </span>

        @isset($branch_arr['children'])
            <x-tree-branch :tree="$branch_arr['children']" :chapters="$chapters"/>
        @endisset

    </div>
@endforeach
