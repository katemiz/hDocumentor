<x-log-layout>

    <x-auth-validation-errors class="notification is-danger is-light mx-4" :errors="$errors" />

    <form method="POST" class="mx-4" action="{{ route('register') }}">
        @csrf

        <div class="columns">
            <div class="column is-half">
                <!-- Name -->
                <x-input name="name" label="{{__('Name')}}" :value="old('name')" placeholder="{{__('Enter your name')}}"/>
            </div>

            <div class="column">
                <!-- Lastname -->
                <x-input name="lastname" label="{{__('Lastname')}}" :value="old('lastname')" placeholder="{{__('Enter your lastname')}}"/>
            </div>
        </div>

        <!-- Email Address -->
        <x-email name="email" :value="old('email')" />

        <div class="columns">

            <div class="column is-half">
                <!-- Password -->
                <x-password name="password" label="{{__('Password')}}" :value="old('password')" placeholder="{{__('Your Password')}}" />
            </div>

            <div class="column is-half">
                <!-- Password -->
                <x-password name="password_confirmation" label="{{__('Confirm Password')}}" :value="old('password_confirmation')" placeholder="{{__('Confirm Password')}}" />
            </div>
        </div>

        <button class="button is-primary my-6 is-fullwidth">{{ __('Register') }}</button>

        <!-- Other Actions Links -->
        <x-auth-actions action="register"/>

    </form>

</x-log-layout>
