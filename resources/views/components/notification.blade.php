
@switch($notification['status'])
    @case('success')
        <div class="notification is-primary is-light">
            {{$notification['msg']}}
        </div>
        @break

    @default
        <div class="notification is-danger">
            BUG : Status is not passed to notification
        </div>
        @break

@endswitch




