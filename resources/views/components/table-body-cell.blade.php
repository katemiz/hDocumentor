<tr>
    @foreach ($columns as $colname => $colprops)

        @if ($colprops['show'])
        <td>
            @if ($colprops['html'])
                {!!$item->{$colname} !!}
            @else
                {{$item->{$colname} }}
            @endif
        </td>
        @endif

    @endforeach

    @if ($hasaction)

        <td>
            @if ($item->status == 'signed')
                <span class="icon is-small ml-3">
                    <x-heroicon-o-check class="has-text-primary"/>
                </span>
            @else
                &nbsp;
            @endif
        </td>

        <td class="has-text-right">

            @if ($actions['view']['status'])
                <a href="{{$actions['view']['route']}}{{$item->id}}" class="icon">
                    <x-heroicon-o-eye class="has-text-link"/>
                </a>
            @endif

            @if ($item->status != 'signed')
                @if ($actions['edit']['status'])
                <a href="{{$actions['edit']['route']}}{{$item->id}}" class="icon">
                    <x-heroicon-o-pencil class="has-text-link"/>
                </a>
                @endif
            @endif

        </td>
    @endif
</tr>


