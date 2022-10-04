<section class="p-3  has-background-grey-ter">

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/loadckeditor.js') }}"></script>


    <div class="columns">

        <div class="column is-3 has-background-warning-light">

            <div class='column'>

                <div class="columns">

                    <div class="column menu-label">Chapters</div>

                    <div class="column is-narrow has-text-right">

                        <span class="icon is-small ">
                            <a wire:click="addBranch">
                                <x-heroicon-o-plus-circle class="has-text-link"/>
                            </a>
                        </span>

                    </div>
                </div>
            </div>


            {{-- <div class="column py-4" tree-root >
                @if (count($doctree->chapters) >0 )
                    <x-tree-branch :branches="$doctree->chapters" istop="{{true}}" parent="0"/>
                @else
                    <div>No tree info</div>
                @endif
            </div> --}}


            <div class="column py-4" root >

                <input type="label" id="selected_parent" value="0" />

                @if ( count($tree) > 0 )
                {{-- <pre>
                @php
                    print_r($tree);
                    print_r($chapters);
                @endphp
                </pre> --}}

                    <x-tree-branch :tree="$tree" :chapters="$chapters"/>
                @else
                    <div>No branch exists</div>
                @endif
            </div>

            {{-- <div class="column has-text-right">
                <span id="Icons" >
                    <span class="icon is-small ">
                        <a wire:click="addBranch">
                            <x-heroicon-o-plus-circle class="has-text-link"/>
                        </a>
                    </span>
                </span>
            </div> --}}

        </div>

        <div class="column">








                <pre>
                @php












                    // print_r($chapters);
                @endphp
                </pre>


            @switch($action)

                @case('welcome')
                    <x-tree-welcome :doctree="$doctree"/>
                    @break

                @case('gui')
                    <x-tree-branch-gui :title="$title" :content="$content"/>
                    @break

                @case('view')
                    <x-tree-branch-view :chapter="$chapter"/>
                    @break

                @default

            @endswitch
        </div>

    </div>

    <script src="{{ asset('/js/tree.js') }}"></script>


</section>
