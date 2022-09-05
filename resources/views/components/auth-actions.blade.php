@switch($attributes['action'])

    @case('login')

        {{-- Forgot Password :: Register --}}
        <div class="columns">
            <div class="column is-half">
                <p class="is-size-6 has-text-weight-light my-3">
                    <a href="/forgot-password">{{__('Forgot password?')}}</a>
                </p>
            </div>

            <div class="column">
                <p class="has-text-right is-size-6 has-text-weight-light my-3">
                    <a href="/register">{{__('Register')}}</a>
                </p>
            </div>
        </div>

        @break


    @case('register')

        {{-- Forgot Password :: Login --}}

        <div class="columns">
            <div class="column is-half">
                <p class="is-size-6 has-text-weight-light my-3">
                    <a href="/forgot-password">{{__('Forgot password?')}}</a>
                </p>
            </div>

            <div class="column">
                <p class="has-text-right is-size-6 has-text-weight-light my-3">
                    <a href="/login">{{__('Log In')}}</a>
                </p>
            </div>
        </div>

        @break




    @case('fpassword')

        {{-- Login :: Register --}}

        <div class="columns">
            <div class="column is-half">
                <p class="is-size-6 has-text-weight-light my-3">
                    <a href="/login">{{__('Log In')}}</a>
                </p>
            </div>

            <div class="column">
                <p class="has-text-right is-size-6 has-text-weight-light my-3">
                    <a href="/register">{{__('Register')}}</a>
                </p>
            </div>
        </div>

        @break

@endswitch
