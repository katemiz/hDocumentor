<section class="section box container">

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/loadckeditor.js') }}"></script>

    <script>
        document.addEventListener('livewire:load', function () {
            loadEditor(`Write meeting minutes here`)
        })
    </script>


    <h1 class="title mb-6 has-text-weight-light is-size-1">{{$mom ? 'Update MOM':'New MOM'}}</h1>

    <form action="/mom-dbact{{$mom ? '/'.$mom->id:''}}" method="POST" enctype="multipart/form-data" >
        @csrf

        <div class="field">
            <label class="label">{{__('Author')}}</label>
            <div class="control">
                <input class="input" type="text" name="author" value="{{ Auth::user()->name . ' '.Auth::user()->lastname}}" readonly>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="field">
                    <label class="label" for="mplace">Meeting Place</label>
                    <div class="control" id="mplace">
                        <input class="input" type="text" name="place" placeholder="{{__('Meeting place')}}" value="{{$mom ? $mom->place: ''}}">
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="field">
                    <label class="label" for="sdate">Meeting Start Date</label>
                    <div class="control" id="sdate">
                        <input class="input" type="date" name="startdate" value="{{$mom ? $mom->startdate: ''}}">
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="field">
                    <label class="label" for="fdate">Meeting Finish Date</label>
                    <div class="control" id="fdate">
                        <input class="input" type="date" name="finishdate" value="{{$mom ? $mom->startdate: ''}}">
                    </div>
                </div>
            </div>
        </div>


        <div class="field">
            <label class="label">{{__('Meeting Subject')}}</label>
            <div class="control">
                <input class="input" type="text" name="subject" placeholder="{{__('Meeting subject')}}" value="{{$mom ? $mom->subject:''}}">
            </div>
        </div>



        <div class="field" wire:ignore>
            <input type="hidden" name="editor_data" id="ckeditor" value="{{$mom ? $mom->minutes :''}}">
            <label class="label">{{__('Meeting Minutes')}}</label>
            <div class="column" id="editor">{{$mom ? $mom->minutes :''}}</div>
        </div>

        <x-file-upload label="{{__('Attachments')}}" iconlabel="{{__('Files')}}" :files="$mom ?  $mom->dosyalar :false" tcaption="{{__('Available Files')}}" :ismultiple="true"/>

        <div class="column has-text-right">
            <button type="submit" class="button is-link is-light">{{$mom ? 'Update MOM':'Save MOM'}}</button>
        </div>

    </form>


</section>

