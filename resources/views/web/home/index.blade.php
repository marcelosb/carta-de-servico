@extends('web.layouts.master')

@section('content')
    <section class="banner">
        <h1>Carta de Serviços</h1>
        <line></line>
        <p>
            A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, 
            apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.
            A Carta de Serviços ao Usuário é regulamentada pela lei federal nº 13.460, de 26 de junho de 2017.
        </p>
    </section>

    <section class="wrapper">
        <div class="temas--unidades--gestoras" style="border-radius:10px"> 
            @foreach($secretaries as $secretary)
                <a class="bloco" href="{{ route('web.secretary', $secretary->theme_slug) }}">
                    @if($secretary->icon === 'default')
                        <img src="{{ asset('images/web/secretary/icons/default.svg') }}" alt="Ícone {{ $secretary->theme }}">
                    @else
                        <img src="{{ asset($secretary->icon) }}" alt="Ícone {{ $secretary->theme }}">
                    @endif
                     
                    <h1>{{ $secretary->theme }}</h1>
                </a>
            @endforeach
        </div>
    </section>
@endsection

@section('styles')
    <style>
        @font-face {
            font-family: 'Product Sans Black';
            src: url("{{ asset('fonts/product_sans_black.woff') }}");
        }
        @font-face {
            font-family: 'Product Sans Light';
            src: url("{{ asset('fonts/product_sans_light.woff') }}");
        }

        body {
            background-color: #F5F5F5;
        }

        main {
            width: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* SECAO BANNER */
        .banner {
            height: 480px;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* background-image: url("{{ asset('images/web/prefeitura_sede.jpg') }}"); */
            background-repeat: no-repeat;
            background-size: cover;
            color: #293F6B;
            padding: 30px;
        }
        .banner > h1 {
            font-family: 'Product Sans Black', sans-serif;
            font-size: 60px;
            letter-spacing: -2px;
            margin: 0px;
        }
        .banner > line {
            width: 100px;
            border-bottom: 2px solid #F9F9F9;
        }
        .banner > p {
            margin-top: 35px;
            text-align: center;
            font-family: 'Product Sans Light', sans-serif;
            font-size: 18px;
            padding: 0px 80px;
        }

        /* TEMAS UNIDADES GESTORAS */
        .temas--unidades--gestoras {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            flex-wrap: wrap;
            margin-top: -270px;
            box-shadow: 0px 0px 3px #DDDDDD;
            padding: 20px;
            background-color: #FFFFFF;
        }
        .temas--unidades--gestoras > .bloco {
            width: 22%;
            height: 205px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            border-radius: 5px;
            margin: 10px;
            padding: 5px;
            text-decoration: none;
            color: #181818;
            transition: transform 0.6s;
            /* box-shadow: 0 10px 30px 0 rgb(47 60 74 / 8%); */
        }
        .temas--unidades--gestoras > .bloco:hover {
            /* background-color: #F6CB2F; */
            /* background-color: #FFF; */
            background-color: #DDDDDD;
            /* box-shadow: 0 10px 30px 0 rgb(47 60 74 / 8%); */
            transform: scale(1.1);
        }
        .temas--unidades--gestoras > .bloco > img {
            width: 150px; 
            height: 150px;
        }
        .temas--unidades--gestoras > .bloco > h1 {
            width: 230px;
            margin-top: 0px;
            font-size: 20px;
            text-align: center;
            font-family: 'Product Sans Black', sans-serif;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* DESKTOP LARGER */
        @media screen and (min-width: 1185px) and (max-width: 1286px) {
            /* BLOCO - UNIDADES GESTORAS */
            .temas--unidades--gestoras > .bloco {
                width: 22%;
                height: 170px;
            }
            .temas--unidades--gestoras > .bloco > img {
                width: 120px; 
                height: 120px;
            }
            .temas--unidades--gestoras > .bloco > h1 {
                width: 200px;
                font-size: 18px;
            }
        }

        /* DESKTOP */
        @media screen and (min-width: 1000px) and (max-width: 1184px) {
            /* BLOCO - UNIDADES GESTORAS */
            .temas--unidades--gestoras > .bloco {
                width: 21%;
                height: 170px;
            }
            .temas--unidades--gestoras > .bloco > img {
                width: 110px; 
                height: 110px;
            }
            .temas--unidades--gestoras > .bloco > h1 {
                width: 180px;
                margin-top: 10px;
                font-size: 15px;
            }
        }

        /* TABLET LARGER */
        @media screen and (min-width: 768px) and (max-width: 999px) {
            /* BLOCO - UNIDADES GESTORAS */
            .temas--unidades--gestoras > .bloco {
                width: 28%;
                height: 170px;
            }
            .temas--unidades--gestoras > .bloco > img {
                width: 110px; 
                height: 110px;
            }
            .temas--unidades--gestoras > .bloco > h1 {
                width: 160px;
                margin-top: 10px;
                font-size: 14px;
            }
        }

        /* TABLET SMALL */
        @media screen and (min-width: 600px) and (max-width: 767px) {
            .banner > p {
                margin-top: 20px;
                text-align: center;
                font-family: 'Product Sans Light', sans-serif;
                font-size: 16px;
                padding: 0px 80px;
            }
            /* BLOCO - UNIDADES GESTORAS */
            .temas--unidades--gestoras > .bloco {
                width: 42%;
                height: 170px;
            }
            .temas--unidades--gestoras > .bloco > h1 {
                width: 190px;
                margin-top: 10px;
                font-size: 15px;
            }
        }

        /* SMARTPHONE LARGER */
        @media screen and (min-width: 520px) and (max-width: 599px) {
            .banner > h1 {
                font-size: 40px;
                letter-spacing: -1px;
            }
            .banner > p {
                margin-top: 20px;
                font-size: 12px;
                padding: 0px 40px; 
            }
            /* BLOCO - UNIDADES GESTORAS */
            .temas--unidades--gestoras {
                margin-top: -340px;
            }
            .temas--unidades--gestoras > .bloco {
                width: 42%;
                height: 170px;
            }
            .temas--unidades--gestoras > .bloco > img {
                width: 110px; 
                height: 110px;
            }
            .temas--unidades--gestoras > .bloco > h1 {
                width: 170px;
                margin-top: 10px;
                font-size: 15px;
            }
        }

        /* SMARTPHONE SMALL */
        @media screen and (min-width: 400px) and (max-width: 519px) {
            .banner > h1 {
                font-size: 40px;
                letter-spacing: -1px;
            }
            .banner > p {
                margin-top: 20px;
                font-size: 12px;
                padding: 0px 40px; 
            }
            /* BLOCO - UNIDADES GESTORAS */
            .temas--unidades--gestoras {
                margin-top: -310px;
                padding: 10px;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .temas--unidades--gestoras > .bloco {
                width: 80%;
                height: 205px;
                border-radius: 5px;
                margin: 10px;
                padding: 5px;
            }
            .temas--unidades--gestoras > .bloco > h1 {
                width: 230px;
                margin-top: 10px;
                font-size: 15px;
            }
        }

        /* SMARTPHONE EXTRA SMALL */
        @media screen and (min-width: 0px) and (max-width: 399px) {
            .menu-mobile {
                margin-right: 20px;
            }
            .wrapper {
                padding: 0px 20px;
            }
            .banner > h1 {
                font-size: 26px;
                letter-spacing: 0px;
            }
            .banner > p {
                margin-top: 15px;
                font-size: 15px;
                padding: 0px 5px;
            }
            /* BLOCO - UNIDADES GESTORAS */
            .temas--unidades--gestoras {
                padding: 10px;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .temas--unidades--gestoras > .bloco {
                width: 80%;
                height: 205px;
                border-radius: 5px;
                margin: 10px;
                padding: 5px;
            }
            .temas--unidades--gestoras > .bloco > h1 {
                width: 170px;
                margin-top: 10px;
                font-size: 15px;
            }
            .conteudo > fieldset > legend {
                font-size: 18px !important;
            }

        }
    </style>
@endsection
