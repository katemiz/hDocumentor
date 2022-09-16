
<section class="section container">

    {{-- <ul tree-root="reorder2">
        @foreach ($chapters as $chapter)

            <li tree-branch="A{{$chapter->id}}" wire:key="{{$chapter->id}}" draggable="true" class="box my-1" >
                {{$chapter->id}} {{$chapter->content}}
            </li>

        @endforeach
    </ul> --}}




    <div class='content'>
        <h3 class='subtitle'>
             Chapters
        </h3>

        @if($dizin && count($dizin) >0)



            <ul class="" tree-root="reorder">
                @foreach($dizin as $k => $branch)
                    <li
                        class="nobullet"
                        order="ORDER {{$k}}"
                        tree-branch="{{$branch['id']}}"
                        wire:key="{{$branch['id']}}"
                        parentId="{{$branch['parent_id']}}"
                        draggable="true">

                        <span id="Span{{$branch['id']}}">
                        {{$branch['id']}} - {{$branch['content']}} ORDER {{$k}} PARENT {{$branch['parent_id']}}
                        </span>
                        @if($branch['children'])
                            <x-tree-branch :branches="$branch['children']" />
                        @endif
            </li>
                @endforeach
                </ul>





            {{-- <x-tree-branch :branches="$dizin" istop="{{true}}" /> --}}

        @endif
    </div>





















    <hr>

    <div class="content has-background-warning">

        <ul>
            <li>1. sdnfsdjfnsd sfsdnfjsdn 92234 ffık sdknfsdfsdf
                <ul>
                    <li>4. sdfksdmkf sdfksdkfd sdnfsdjfnsd sfsdnfjsdn 92234 ffık sdknfsdfsdf </li>
                    <li>5. sdfsd 456456sdfksdmkf sdfksdkfd sdnfsdjfnsd sfsdnfjsdn 92234 ffık sdknfsdfsdf </li>


                </ul>
            </li>
            <li>2. 4444444444 444 sdnfsdjfnsd sfsdnfjsdn 92234 ffık sdknfsdfsdf</li>
            <li>3. fjdfjsdıjfısd4444444444 444 sdnfsdjfnsd sfsdnfjsdn 92234 ffık sdknfsdfsdf</li>

        </ul>
    </div>

    <script>

        let root = document.querySelector('[tree-root]')

        root.querySelectorAll('[tree-branch').forEach(el => {

            el.addEventListener('dragstart',e => {
                e.target.setAttribute('suruklenen',true)
            })

            el.addEventListener('drop',e => {
                e.target.classList.remove('has-background-info-light','box','withborder')

                let suruklenenEl = root.querySelector('[suruklenen]')
                e.target.before(suruklenenEl)

                // Refresh livewire component
                let component = Livewire.find(
                    e.target.closest('[wire\\:id]').getAttribute('wire:id')
                )

                let orderIds = Array.from(root.querySelectorAll('[tree-branch]')).map(itemEl =>
                    itemEl.getAttribute('tree-branch')
                )

                let method = root.getAttribute('tree-root')

                //component.call(method,orderIds)

                console.log("Suruklenen parent id : ",suruklenenEl.getAttribute('parentId'))
                console.log("Target parent id : ",e.target.getAttribute('parentId'))

            })

            el.addEventListener('dragenter',e => {
                e.preventDefault()
                e.target.classList.add('has-background-info-light','box','withborder')

                let eSpan = document.getElementById('Span'+e.target.id)

                console.log("ESPAN",e.target.id)

            })

            el.addEventListener('dragover',e => {
                e.preventDefault()
            })


            el.addEventListener('dragleave',e => {
                e.target.classList.remove('has-background-info-light','box','withborder')
            })


            el.addEventListener('dragend',e => {
                e.target.removeAttribute('suruklenen')
            })

        });

    </script>

</section>



