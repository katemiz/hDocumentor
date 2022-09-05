



<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8" />

    {{-- <link  rel="icon" type="image/svg+xml" href="{{ asset(Config::get('constants.favicon')) }}" /> --}}

    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" /> --}}
    {{-- <link  href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <link  href="{{ asset('/css/bulma.css') }}" rel="stylesheet" /> --}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap">


    <style>

    /* open-sans-regular - latin-ext */

    * {
        font-family: "Nunito", sans-serif;

    }




    body {
      font-family: "Nunito", sans-serif;
    }





            /** Define the margins of your page **/
            /* @page {
                margin: 200px 70px;


            } */

            .header {

                padding-bottom: 70px;
                font-family: "Dosis", sans-serif;
            }

            footer {
                position: fixed;
                bottom: -60px;
                left: 0px;
                right: 0px;
                height: 50px;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }


            .left {
                text-align: left;
                width:25%;
            }

            .right {
                text-align: right;
            }


            table {
                margin:100px 70px;


            }









    </style>











  </head>
  <body>

    <section class="section container">






        <table>

            <tr>

                <th class="left header">kapkara mühendislik danışmanlık</th>

            </tr>
            <tr>
                <th class="left">

                BESTE SOK 2/2<br>
                ETLİK ANKARA<br>
                (90) 555 286 31 10<br>
                katemiz@gmail.com<br>
                https://kapkara.one<br>


                </th>

                <th class="right">
                    {!! QrCode::size(100)->generate(Request::url()); !!}

                </th>

            </tr>




            @if ($letter->toCompany)
            <tr>
                <td colspan="2">{{ $letter->toCompany }}</td>
            </tr>
            @endif

            @if ($letter->toPerson)
            <tr>
                <td colspan="2">{{ $letter->toPerson }}</td>
            </tr>
            @endif



            @if ($letter->toPerson)
            <tr>
                <td colspan="2">{{ $letter->toPerson }}</td>
            </tr>
            @endif

            <tr>
                <td colspan="2">{{ $letter->updated_at }}</td>
            </tr>

            @if ($letter->toPerson)
            <tr>
                <td colspan="2">
                    References : <br>
                    <ol>
                        <li>{{$letter->references }}</li>
                    </ol>
                </td>
            </tr>
            @endif


            @if ($letter->subject)
            <tr>
                <td>Subject</td>
                <td>{{ $letter->subject }}</td>
            </tr>
            @endif

            <tr>
                <td colspan="2">{!! $letter->content !!}</td>
            </tr>

        </table>


        <footer class="has-background-light">

            <p class="has-text-grey mt-6 pt-6 px-1">B{{$letter->id}}</p>
        </footer>


    </section>

  </body>
</html>








