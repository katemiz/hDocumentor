<section class="section box container">

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/loadckeditor.js') }}"></script>

    <script>
        document.addEventListener('livewire:load', function () {
            loadEditor(`Type the letter content here`)
        })

        function removeRef(no) {
            document.getElementById('refcontrol'+no).remove()
        }
    </script>


    <h1 class="title mb-6 has-text-weight-light is-size-1">{{$letter ? 'Update Company':'New Company'}}</h1>

    <form action="/letter-dbact{{$letter ? '/'.$letter->id:''}}" method="POST" enctype="multipart/form-data" >
        @csrf

        <div class="field">
            <label class="label">To Company </label>
            <div class="control">
                <input class="input" type="text" name="to_company" placeholder="Text input" value="{{$letter ? $letter->toCompany:''}}">
            </div>
        </div>

        <div class="field">
            <label class="label">To Person </label>
            <div class="control">
                <input class="input" type="text" name="to_person" placeholder="Text input" value="{{$letter ? $letter->toPerson:''}}">
            </div>
        </div>

        <div class="field">

            <label class="label">References
                <span class="icon-text">
                    <span class="icon">
                        <a wire:click="addRef">
                            <x-heroicon-o-plus class="has-text-link"/>
                        </a>
                    </span>
                </span>
            </label>


            @for ($i = 1; $i <= $noOfReferences; $i++)
            <div class="control columns" id="refcontrol{{$i}}">
                <div class="column is-narrow">Ref {{$i}}</div>
                <div class="column">
                    <input class="input" type="text" name="references[]" placeholder="Reference text"  value="{{isset($letter->refarray[$i-1]) ? $letter->refarray[$i-1]:''}}">
                </div>

                @if ($i > 1)
                <div class="column is-narrow">
                    <a onclick="removeRef({{$i}})">
                    <span class="icon">
                        <x-heroicon-o-x-mark class="has-text-danger"/>
                    </span>
                    </a>
                </div>
                @endif
            </div>
            @endfor

        </div>

        <div class="field">
            <label class="label">Subject</label>
            <div class="control">
                <input class="input" type="text" name="subject" placeholder="Subject of letter" value="{{$letter ? $letter->subject:''}}">
            </div>
        </div>

        <div class="field" wire:ignore>
            <input type="hidden" name="editor_data" id="ckeditor" value="{{$letter ? $letter->content :''}}">
            <label class="label">Letter Main Content</label>
            <div class="column" id="editor">{{$letter ? $letter->content :''}}</div>
        </div>

        <x-file-upload label="Attachments" iconlabel="Files" :files="$letter ?  $letter->dosyalar :false" tcaption="Available Files"/>

        <div class="column has-text-right">
            <button type="submit" class="button is-link is-light">{{$letter ? 'Update Company':'Save Company'}}</button>
        </div>

    </form>


</section>

