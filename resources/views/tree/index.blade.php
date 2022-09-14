
<section class="section container">

    <ul tree-root="reorder">
        @foreach ($chapters as $chapter)

            <li tree-branch="{{$chapter->id}}" wire:key="{{$chapter->id}}" draggable="true" class="box my-1" >
                {{$chapter->id}} {{$chapter->content}}
            </li>

        @endforeach
    </ul>

    {{-- @php
        print_r($chapters)
    @endphp
    --}}

    @foreach ($chapters as $chapter)

    <h1>{{$chapter->id}}</h1>
        {{-- <p>{{$chapter->content}}</p>
        <p>{{$chapter->parent}}</p> --}}


    @endforeach


    <script>

        let root = document.querySelector('[tree-root]')

        root.querySelectorAll('[tree-branch').forEach(el => {

            el.addEventListener('dragstart',e => {
                e.target.setAttribute('suruklenen',true)
            })

            el.addEventListener('drop',e => {
                e.target.classList.remove('has-background-info-light')

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

                component.call(method,orderIds)
            })

            el.addEventListener('dragenter',e => {
                e.preventDefault()
                e.target.classList.add('has-background-info-light')
            })

            el.addEventListener('dragover',e => {
                e.preventDefault()
            })


            el.addEventListener('dragleave',e => {
                e.target.classList.remove('has-background-info-light')
            })


            el.addEventListener('dragend',e => {
                e.target.removeAttribute('suruklenen')
            })

        });

    </script>

</section>



