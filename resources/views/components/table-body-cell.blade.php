
<tr>
@foreach ($columns as $colname => $colprops)

    @if ($colprops['show'])
    <td>
        @if ($colprops['html'])
        {!!$letter->{$colname} !!}
        @else
        {{$letter->{$colname} }}
        @endif
    </td>
    @endif

@endforeach

@if ($hasaction)
    <td class="has-text-right">

        @if ($actions['view']['status'])
        <a href="{{$actions['view']['route']}}{{$letter->id}}" class="icon">
            <x-heroicon-o-eye class="has-text-link"/>
        </a>
        @endif

        @if ($actions['edit']['status'])
        <a href="{{$actions['edit']['route']}}{{$letter->id}}" class="icon">
            <x-heroicon-o-pencil class="has-text-link"/>
        </a>
        @endif

        {{-- @if ($actions['delete']['status'])
        <a wire:click="$emit('triggerDelete',{{ $letter->id }})"  class="icon">
            <x-heroicon-o-trash class="has-text-danger"/>
        </a>
        @endif --}}

    </td>
@endif
</tr>


