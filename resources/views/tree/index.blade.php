<section class="p-3  has-background-grey-ter">

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/loadckeditor.js') }}"></script>

    <script>
        window.addEventListener('contentChanged', (e) => {
            loadEditor(`Type the actionnnn item description here`)
            getTreeStructure(root)
        });


        function validateMyForm() {

            let title = document.getElementById('title').value
            let content = document.getElementById('ckeditor').value

            console.log(title)
            console.log(content)

            window.livewire.emit('save', title,content)
        }
    </script>


















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


            <div class="column py-4" tree-root >
                @if (count($doctree->chapters) >0 )
                    <x-tree-branch :branches="$doctree->chapters" istop="{{true}}" parent="0"/>
                @else
                    <div>No tree info</div>
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
