<x-app-layout>

    <section class="section container" >

        <div class="columns has-background-warning">
            <div class="column">
                <h1 class="title has-text-weight-light is-size-1">Minutes of Meeting</h1>
            </div>

            <div class="column has-text-right">

                @if ($mom->status == 'signed')

                    <span class="tag is-success">
                        {{strtoupper($mom->status)}}
                        <span class="icon is-small ml-3">
                            <x-heroicon-o-check/>
                        </span>
                    </span>

                @else

                    <a href="/mom-gui/{{$mom->id}}">
                        <span class="icon is-small">
                            <x-heroicon-s-pencil class="has-text-link"/>
                        </span>
                    </a>

                    <a onclick="confirmDelete('{{$mom->id}}','mom')">
                        <span class="icon is-small">
                            <x-heroicon-s-trash class="has-text-danger"/>
                        </span>
                    </a>

                @endif

            </div>
        </div>


        {{-- VIEW BODY --}}





        <div class="column">
            <div class="columns">

                <div class="column is-8">

                    <table class="table is-fullwidth">

                        <tr>
                            <th class="has-text-right">Author</th>
                            <td>{{$mom->author->name.' '. $mom->author->lastname}}</td>
                        </tr>

                        <tr>
                            <th class="has-text-right">Meeting Number</th>
                            <td>MOM-{{$mom->id }}</td>
                        </tr>

                        <tr>
                            <th class="has-text-right">Meeting Place</th>
                            <td>{{$mom->place}}</td>
                        </tr>

                        <tr>
                            <th class="has-text-right">Meeting Date</th>
                            <td>{{$mom->startdate}} {{$mom->finishdate ? ' - '. $mom->finishdate :''}}</td>
                        </tr>
                    </table>

                </div>

                <div class="column has-text-right">
                    {!! QrCode::size(100)->generate(Request::url()); !!}
                    <br>
                    @if ($mom->status == 'signed')
                        {{$mom->letterno}}
                    @else
                        {{strtoupper($mom->status)}}
                    @endif
                </div>

            </div>
        </div>

        <h2 class="subtitle has-text-info">{{$mom->subject}}</h2>

        <h2 class="subtitle">Meeting Minutes</h2>

        <div class="column">
            {!! $mom->minutes !!}
        </div>

        <h2 class="subtitle">Decisions</h2>




        <!-- Main container -->
        <nav class="level">
            <!-- Left side -->
            <div class="level-left">
                <h2 class="subtitle">Action Items</h2>
            </div>

            <!-- Right side -->
            <div class="level-right">
                <p class="level-item">
                    <a href="/mom-ai-gui/{{$mom->id}}" class="button is-success">Add AI</a>
                </p>
            </div>
        </nav>


        @if (count($mom->aitems) > 0)

            <table class="table is-fullwidth is-bordered">
                <tr>
                    <th class="is-narrow">No</th>
                    <th>Required Action Description</th>
                    <th>Due Date</th>
                    <th class="is-narrow">&nbsp;</th>
                </tr>

                @foreach ($mom->aitems as $key => $aitem)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{!!$aitem->description!!}</td>
                        <td>{{$aitem->duedate}}</td>
                        <td>
                            <a href="/ai-gui/{{$aitem->id}}">
                                <span class="icon is-small">
                                    <x-heroicon-s-pencil class="has-text-link"/>
                                </span>
                            </a>

                            <a onclick="confirmDelete('{{$aitem->id}}','aitem')">
                                <span class="icon is-small">
                                    <x-heroicon-s-trash class="has-text-danger"/>
                                </span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else

            <div class="notification is-warning is-light">
                No action items for this MOM.
            </div>

        @endif

        <h2 class="subtitle">Attachments</h2>

        @if (count($mom->dosyalar) > 0)
        <div class="column">

            @foreach ($mom->dosyalar as $key => $dosya )
                <p>
                    <span class="has-text-weight-bold">{{__('Attach')}} {{ ++$key }}</span>
                    <span class="has-text-weight-light">{{$dosya->filename }}</span>
                </p>
            @endforeach
        </div>
        @else

            <div class="notification is-warning is-light">
                No attachments for this MOM.
            </div>

        @endif

    </section>

</x-app-layout>
