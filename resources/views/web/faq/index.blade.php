@extends('web.layouts.master')

@section('content')
    <section class="header--faq">
        <h1>{{ $faq->title }}</h1>
        <div class="line"></div>
    </section>

    <section class="wrapper">
        <div class="content--faq">
            {!! $faq->content !!}
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
            font-family: 'Product Sans Regular';
            src: url("{{ asset('fonts/product_sans_regular.woff') }}");
        }

        /* CABEÇALHO - PERGUNTAS FREQUENTES */
        .header--faq {
            width: 100%;
            height: 210px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 50px;
            background-color: #4071D9;
        }
        .header--faq > h1 {
            width: 55%;
            font-family: 'Product Sans Regular', sans-serif;
            font-size: 48px;
            font-weight: 100;
            text-align: center;
            margin: 0px;
            color: #FFFFFF;
        }
        .header--faq > .line {
            width: 80px;
            border-bottom: 1px solid #FFFFFF;
        }

        /* CONTEÚDO - PERGUNTAS FREQUENTES */
        .content--faq {
            padding: 40px 0px 20px 0px;
        }
        .content--faq > h2 {
            font-family: 'Product Sans Black', sans-serif;
            margin: 0px;
            color: #111111;
            letter-spacing: -1px;
            word-spacing: 1px;
        }
        .content--faq > p {
            margin-top: 5px;
            color: #333333;
        }

        /* DESKTOP LARGER */
        @media screen and (min-width: 740px) and (max-width: 850px) {
            .header--faq {
                height: 200px;
                padding: 25px;
            }
            .header--faq > h1 {
                width: 50%;
                font-size: 40px;
            }
        }

        /* TABLET */
        @media screen and (min-width: 500px) and (max-width: 739px) {
            .header--faq {
                height: 200px;
                padding: 25px;
            }
            .header--faq > h1 {
                width: 80%;
                font-size: 35px;
            }
        }

        /* SMARTPHONE */
        @media screen and (min-width: 0px) and (max-width: 499px) {
            .header--faq {
                height: 120px;
                padding: 15px;
            }
            .header--faq > h1 {
                width: 80%;
                font-size: 25px;
            }
        }
    </style>
@endsection
