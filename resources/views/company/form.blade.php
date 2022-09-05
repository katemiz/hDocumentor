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


    <h1 class="title mb-6 has-text-weight-light is-size-1">{{$company ? 'Update Company':'New Company'}}</h1>

    <form action="/company-dbact{{$company ? '/'.$company->id:''}}" method="POST" enctype="multipart/form-data" >
        @csrf

        <div class="field">
            <label class="label">Company Name </label>
            <div class="control">
                <input class="input" type="text" name="company_name" placeholder="Company Name" value="{{$company ? $company->toCompany:''}}">
            </div>
        </div>



        <div class="field">
            <label class="label">E-Mail (Offical Contact EMail/Person)</label>
            <div class="control">
                <input class="input" type="text" name="email" placeholder="E-Mail" value="{{$company ? $company->toPerson:''}}">
            </div>
        </div>


        <div class="field">
            <label class="label">Web Site URL</label>
            <div class="control">
                <input class="input" type="text" name="url" placeholder="Web Site URL" value="{{$company ? $company->toPerson:''}}">
            </div>
        </div>


        <div class="field">
            <label class="label">Phone Number</label>
            <div class="control">
                <input class="input" type="text" name="phone" placeholder="Phone number" value="{{$company ? $company->toPerson:''}}">
            </div>
        </div>


        <div class="field">
            <label class="label">Tax Number</label>
            <div class="control">
                <input class="input" type="text" name="tax_number" placeholder="Tax number" value="{{$company ? $company->toPerson:''}}">
            </div>
        </div>



        <div class="field" wire:ignore>
            <input type="hidden" name="editor_data" id="ckeditor" value="{{$company ? $company->content :''}}">
            <label class="label">Address</label>
            <div class="column" id="editor">{{$company ? $company->content :''}}</div>
        </div>

        <x-file-upload label="Attachments" iconlabel="Files" :files="$company ?  $company->dosyalar :false" tcaption="Available Files"/>

        <div class="column has-text-right">
            <button type="submit" class="button is-link is-light">{{$company ? 'Update Company':'Save Company'}}</button>
        </div>

    </form>


</section>

