{{-- TABLE HEAD ROW --}}



<thead>
    <tr>
        @foreach ($columns as $colname => $column)
            @if ($column['show'])
            <th>
                <span class="icon-text" wire:click="sortBy('{{$colname}}')">
                    <span class="icon {{ $column['sdirection'] === 'asc' ? 'is-hidden' : ''}}">
                        <x-heroicon-o-chevron-up class="has-text-link"/>
                    </span>
                    <span class="icon {{ $column['sdirection']  === 'desc' ? 'is-hidden' : ''}}">
                        <x-heroicon-o-chevron-down class="has-text-link"/>
                    </span>
                    <span>{{$column['header']}}</span>
                </span>
            </th>
            @endif
        @endforeach

        @if ($hasaction)
            <th class="has-text-right is-2">Actions</th>
        @endif
    </tr>
</thead>



{{--
@if ($type == 'head')

    @if ($colprops['show'])
    <th>
        <span class="icon-text" wire:click="sortBy('{{$colprops['colname']}}')">
            <span class="icon {{ $colprops['sdirection'] === 'asc' ? 'is-hidden' : ''}}">
                <x-heroicon-o-chevron-up class="has-text-link"/>
            </span>
            <span class="icon {{ $colprops['sdirection']  === 'desc' ? 'is-hidden' : ''}}">
                <x-heroicon-o-chevron-down class="has-text-link"/>
            </span>
            <span>{{$colprops['header']}}</span>
        </span>
    </th>
    @endif


    @if ($colprops['show'])
    <th>
        <span class="icon-text" wire:click="sortBy('{{$colprops['colname']}}')">
            <span class="icon {{ $colprops['sdirection'] === 'asc' ? 'is-hidden' : ''}}">
                <x-heroicon-o-chevron-up class="has-text-link"/>
            </span>
            <span class="icon {{ $colprops['sdirection']  === 'desc' ? 'is-hidden' : ''}}">
                <x-heroicon-o-chevron-down class="has-text-link"/>
            </span>
            <span>{{$colprops['header']}}</span>
        </span>
    </th>
    @endif



@endif


{{-- TABLE BODY CELL --}}
{{-- @if ($type == 'body') --}}


{{-- @endif --}}
