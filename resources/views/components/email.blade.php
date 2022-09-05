<div class="field">

    <label class="label has-text-info has-text-weight-light" for="email">{{__('Email')}}</label>

    <div class="control has-icons-right">

        <input
            class="input"
            type="email"
            name="{{$attributes["name"]}}"
            value="{{$attributes["value"]}}"
            placeholder="{{__('Enter your email')}}" required >
    </div>

    @error($attributes["email"])
    <p class="help is-danger">{{$attributes["email"]}}</p>
    @enderror

</div>
