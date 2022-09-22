<section class="section box container">

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/loadckeditor.js') }}"></script>

    <script>
        document.addEventListener('livewire:load', function () {
            loadEditor(`Type detailed descripttion and remarks about structured data`)
        })
    </script>

    <h1 class="title has-text-weight-light is-size-1">{{$docTree ? 'Update Doc Tree':'New Doc Tree'}}</h1>

    <form action="/doctree-db/{{$docTree ? $docTree->id:''}}" method="POST" enctype="multipart/form-data" >
        @csrf

        <div class="field">
            <label class="label" for="respc">Title/Description</label>
            <div class="control" id="respc">
                <input class="input" type="text" name="title" placeholder="Title/Description of documentation tree" value="{{$docTree ? $docTree->title: ''}}">
            </div>
        </div>

        <div class="field" wire:ignore>
            <input type="hidden" name="editor_data" id="ckeditor" value="{{$docTree ? $docTree->remarks :''}}">
            <label class="label">{{__('Remarks and Notes')}}</label>
            <div class="column" id="editor">{{$docTree ? $docTree->remarks :''}}</div>
        </div>

        <div class="column has-text-right">
            <button type="submit" class="button is-link is-light">{{$docTree ? 'Update Doc Tree':'Save Doc Tree'}}</button>
        </div>

    </form>


</section>

