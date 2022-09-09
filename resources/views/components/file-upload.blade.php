<div class="field">

    <script src="{{ asset('/js/fileupload.js') }}"></script>

    <label class="label">{{$label}}</label>

    <input type="hidden" id="filesToUpload" value="0" autocomplete="off">
    <input type="hidden" id="filesToDelete" name="filesToDelete" value="0" autocomplete="off">
    <input type="hidden" id="filesToExclude" name="filesToExclude" value="0" autocomplete="off">

    <div class="is-hidden" id="xmark_icon">
        <x-heroicon-o-x-mark class="has-text-danger"/>
    </div>


    @if ($files)
    <div class="column">

        <table class="table is-fullwidth">
            <caption>{{$tcaption}}</caption>

            @foreach ($files as $file)
            <tr>
                <td><span id="filetodelete{{$file->id}}">{{$file->filename}}</span></td>
                <td>{{$file->size}}</td>
                <td>{{$file->mimetype}}</td>

                <td>

                    <p class="buttons is-pulled-right">
                        <a onclick="removeFile('{{$file->id}}')" class="is-hidden" id="fileUndelete{{$file->id}}">
                          <span class="icon ">
                            <x-heroicon-o-arrow-uturn-left class="has-text-link"/>
                          </span>
                        </a>
                        <a onclick="removeFile('{{$file->id}}')"  id="fileDelete{{$file->id}}">
                          <span class="icon">
                            <x-heroicon-o-trash class="has-text-danger"/>
                          </span>
                        </a>
                    </p>

                </td>
            </tr>
            @endforeach

        </table>

    </div>
    @endif





    <div class="columns">

        <div class="column is-narrow">
            <div class="file is-boxed">
                <label class="file-label">
                <input
                    class="file-input"
                    type="file"
                    name="dosyalar[]"
                    id="fupload"
                    {{$ismultiple ? 'multiple':''}}
                    onchange="getNames()" />
                <span class="file-cta">
                    <span class="file-icon">
                        <x-heroicon-o-arrow-up-tray class="has-text-link"/>
                    </span>
                    <span class="file-label">{{$iconlabel}}</span>
                </span>
                </label>
            </div>

        </div>

        <div class="column" id="filesList">
            <div class="notification is-warning is-light" id="noFile">

                {{$ismultiple ? 'No new files yet!':'No file yet!'}}

            </div>
        </div>

    </div>

</div>
