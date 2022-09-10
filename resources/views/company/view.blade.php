<x-app-layout>
    <section class="section container">

        <script src="{{ asset('/js/sweetalert2.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/css/sweetalert2_min.css') }}">
        <script src="{{ asset('/js/confirm.js') }}"></script>

        @if ($company->notification)
            {{$company->notification->msg}}
        @endif

        <div class="column has-text-right">

            <a href="/company-gui/{{$company->id}}">
                <span class="icon is-small">
                    <x-heroicon-s-pencil class="has-text-link"/>
                </span>
            </a>

            <a class="ml-3" onclick="confirmDelete('{{$company->id}}','company')">
                <span class="icon is-small">
                    <x-heroicon-s-trash class="has-text-danger"/>
                </span>
            </a>

        </div>

        <h1 class="title mb-6 has-text-weight-light is-size-1">Company Properties</h1>

        <div class="columns box">
            <div class="column is-half">
                <h1 class="title has-text-weight-light is-size-5">{{$company->shortname}}</h1>
                <h2 class="subtitle has-text-weight-light is-size-6">{{$company->fullname}}</h2>


                @if ($company->logos)

                    @foreach ($company->logos as $logo)

                    <img src="{{$logo->imgEncode($logo->stored_as)}}" />

                    @endforeach

                @endif
            </div>

            <div class="column">

                <table class="table is-fullwidth">

                    <tr>
                        <td class="is-narrow">
                            <span class="icon">
                                <x-heroicon-o-map class="has-text-link"/>
                            </span>
                        </td>
                        <td>
                            <address>
                                {!!$company->address!!}
                            </address>
                        </td>
                    </tr>

                    <tr>
                        <td class="is-narrow">
                            <span class="icon">
                                <x-heroicon-o-phone class="has-text-link"/>
                            </span>
                        </td>
                        <td>
                            {{$company->phone}}
                        </td>
                    </tr>

                    <tr>
                        <td class="is-narrow">
                            <span class="icon">
                                <x-heroicon-o-globe-alt class="has-text-link"/>
                            </span>
                        </td>
                        <td>
                            <a href="{{$company->website}}">{{$company->website}}</a>
                        </td>
                    </tr>

                    <tr>
                        <td class="is-narrow">
                            <span class="icon">
                                <x-heroicon-o-at-symbol class="has-text-link"/>
                            </span>
                        </td>
                        <td>
                            <a href="mailto:{{$company->email}}">{{$company->email}}</a>
                        </td>
                    </tr>

                    <tr>
                        <td class="is-narrow">
                            &nbsp;
                        </td>
                        <td>
                            {{$company->tax_no}} (Tax Number)
                        </td>
                    </tr>
                </table>

            </div>
        </div>






    </section>
</x-app-layout>

