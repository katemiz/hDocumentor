<section class="section box container">

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/loadckeditor.js') }}"></script>

    <script>
        document.addEventListener('livewire:load', function () {
            loadEditor(`Type the action item description here`)
        })


    </script>


    <h1 class="title has-text-weight-light is-size-1">{{$ai ? 'Update Action Item':'New Action Item'}}</h1>

    @if ($idMOM > 0)
    <h2 class="subtitle has-text-weight-light">This Action Items Belongs to MOM-{{$idMOM}}</h2>
    @endif

    <form action="/ai-dbact/{{$idMOM}}{{$ai ? '/'.$ai->id:''}}" method="POST" enctype="multipart/form-data" >
        @csrf

        <div class="field" wire:ignore>
            <input type="hidden" name="editor_data" id="ckeditor" value="{{$ai ? $ai->description :''}}">
            <label class="label">{{__('Action Item Description')}}</label>
            <div class="column" id="editor">{{$ai ? $ai->description :''}}</div>
        </div>


        <div class="columns">

            <div class="column">
            <div class="field">
                <label class="label" for="respc">Responsible Company (if any)</label>
                <div class="control" id="respc">
                    <input class="input" type="text" name="resp_company" placeholder="Company name" value="{{$ai ? $ai->resp_company: ''}}">
                </div>
            </div>
            </div>

            <div class="column">
            <div class="field">
                <label class="label" for="respp">Responsible Person (if any)</label>
                <div class="control" id="respp">
                    <input class="input" type="text" name="resp_person" placeholder="Responsible name"value="{{$ai ? $ai->resp_person: ''}}">
                </div>
            </div>
            </div>


            <div class="column">
            <div class="field">
                <label class="label" for="due">Due Date</label>
                <div class="control" id="due">
                    <input class="input" type="date" name="duedate" value="{{$ai ? $ai->duedate: ''}}">
                </div>
            </div>
            </div>

        </div>






        <x-file-upload label="{{__('Attachments')}}" iconlabel="{{__('Files')}}" :files="$ai ?  $ai->dosyalar :false" tcaption="{{__('Available Files')}}" :ismultiple="true"/>

        <div class="column has-text-right">
            <button type="submit" class="button is-link is-light">{{$ai ? 'Update Action Item':'Save Action Item'}}</button>
        </div>

    </form>


</section>

