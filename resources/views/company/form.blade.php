<section class="section box container">

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/loadckeditor.js') }}"></script>

    <script>
        document.addEventListener('livewire:load', function () {
            loadEditor(`Type company address here`)
        })
    </script>

    <h1 class="title mb-6 has-text-weight-light is-size-1">{{$company ? 'Update Company':'New Company'}}</h1>

    <form action="/company-dbact{{$company ? '/'.$company->id:''}}" method="POST" enctype="multipart/form-data" >
        @csrf

        <div class="field">

            <label class="label">Company Type </label>

            <div class="control">
                <label class="radio">
                <input type="radio" name="is_mycompany" value="1" {{$company->is_mycompany ? 'checked':''}}>
                This is my company
                </label>
                <label class="radio">
                <input type="radio" name="is_mycompany" value="0" {{!$company->is_mycompany ? 'checked':''}}>
                No, this a company that we work with
                </label>
            </div>
        </div>

        <div class="columns">

            <div class="column is-4">
            <div class="field">
                <label class="label">Company Short Name </label>
                <div class="control">
                    <input class="input" type="text" name="shortname" placeholder="eg kapkara" value="{{$company ? $company->shortname:''}}">
                </div>
            </div>
            </div>

            <div class="column is-4">
            <div class="field">
                <label class="label">Company Full Name</label>
                <div class="control">
                    <input class="input" type="text" name="fullname" placeholder="eg kapkara Mühendislik Danışmanlık A.Ş" value="{{$company ? $company->fullname:''}}">
                </div>
            </div>
            </div>

            <div class="column is-4">
            <div class="field">
                <label class="label">Web Site URL</label>
                <div class="control">
                    <input class="input" type="text" name="website" placeholder="Web Site URL" value="{{$company ? $company->website:''}}">
                </div>
            </div>
            </div>

        </div>

        <div class="columns">

            <div class="column is-4">
            <div class="field">
                <label class="label">Contact Phone Number(s)</label>
                <div class="control">
                    <input class="input" type="text" name="phone" placeholder="eg +90 555 555 55 55" value="{{$company ? $company->phone:''}}">
                </div>
            </div>
            </div>

            <div class="column is-4">
            <div class="field">
                <label class="label">Contact E-Mail</label>
                <div class="control">
                    <input class="input" type="text" name="email" placeholder="eg info@important.company.com" value="{{$company ? $company->email:''}}">
                </div>
            </div>
            </div>

            <div class="column is-4">
                <div class="field">
                    <label class="label">Company Tax Number</label>
                    <div class="control">
                        <input class="input" type="text" name="tax_no" placeholder="eg 242349943454" value="{{$company ? $company->tax_no:''}}">
                    </div>
                </div>
            </div>

        </div>

        <div class="field" wire:ignore>
            <input type="hidden" name="editor_data" id="ckeditor" value="{{$company ? $company->address :''}}">
            <label class="label">Address</label>
            <div class="column" id="editor">{{$company ? $company->address :''}}</div>
        </div>

        <x-file-upload label="Logo (png, jpg, svg)" iconlabel="Logo File" :files="$company ?  $company->logos :false" tcaption="Company Logo File" :ismultiple="false"/>

        <div class="column has-text-right">
            <button type="submit" class="button is-link is-light">{{$company ? 'Update Company':'Save Company'}}</button>
        </div>

    </form>


</section>

