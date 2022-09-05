<x-log-layout>

    <form method="POST" class="mx-4" action="{{ route('password.update') }}">
        @csrf

        <!-- Validation Errors -->
        <x-auth-validation-errors class="notification is-danger is-light" :errors="$errors" />

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <x-email name="email" :value="old('email')" />


        <!-- Password -->
        <x-password name="password" label="{{__('New Password')}}" :value="old('password')" placeholder="{{__('Your Password')}}" />

        <!-- Password , Confirm-->
        <x-password name="password_confirmation" label="{{__('Confirm Password')}}" :value="old('password_confirmation')" placeholder="{{__('Confirm Password')}}" />

        <button class="button is-dark my-6 is-fullwidth">{{ __('Reset Password') }}</button>

    </form>

</x-log-layout>
