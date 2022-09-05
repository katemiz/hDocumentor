@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'notification is-success is-light']) }}>
        {{ $status }}
    </div>
@endif
