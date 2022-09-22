<div class="box">

    <h1 class="title has-text-weight-light is-size-1">New Branch for Doc Tree</h1>

    <form onsubmit="event.preventDefault(); validateMyForm();">

        @csrf

        <div class="field">
            <label class="label" for="respc">Title/Header</label>
            <div class="control" id="respc">
                <input class="input" type="text" id="title" placeholder="Company name" value="{{$title}}">
            </div>
        </div>

        <div class="field" wire:ignore>
            <input type="hidden" name="editor_data" id="ckeditor" value="{{$content}}">
            <label class="label">{{__('Action Item Description')}}</label>
            <div class="column" id="editor">{{$content}}</div>
        </div>

        <div class="column has-text-right">
            <button type="submit" class="button is-link is-light">Save</button>
        </div>

    </form>

</div>
