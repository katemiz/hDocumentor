{{-- TABLE HEAD ROW --}}
<thead>
    <tr>
        @foreach ($columns as $colname => $column)
            @if ($column['show'])
            <th onmouseover="tableHeadCellHover('{{$colname}}','in')" onmouseout="tableHeadCellHover('{{$colname}}','out')">
                {{$column['header']}}
                <span class="icon-text is-hidden" id="th{{$colname}}" >
                    {{-- <span>{{$column['header']}}</span> --}}

                    <a wire:click="sortBy('{{$colname}}','asc')">
                    <span class="icon {{ $column['sdirection'] === 'asc' ? 'is-hidden' : ''}}">
                        <x-heroicon-o-chevron-up class="has-text-link"/>
                    </span>
                    </a>

                    <a wire:click="sortBy('{{$colname}}','desc')">
                    <span class="icon {{ $column['sdirection']  === 'desc' ? 'is-hidden' : ''}}">
                        <x-heroicon-o-chevron-down class="has-text-link"/>
                    </span>
                    </a>
                </span>
            </th>
            @endif
        @endforeach

        @if ($hasaction)
            <th class="has-text-right is-2">Actions</th>
        @endif
    </tr>
</thead>
