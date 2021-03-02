@extends('web.layouts.master')

@section('content')
    <main style="background-color:#FFFFFF; width: 100vw;">
        <section class="wrapper">
            @if(count($services))
                <section class="bloco--secretaria">
                    <div class="titulo">{{ $secretary->theme }}</div>
                    <div class="conteudo">
                        <fieldset>
                            <legend>SERVIÇOS DA SECRETARIA</legend>
                            <div class="bloco--geral--servicos">
                                @foreach($services as $service)
                                    <a href="{{ route('web.secretary.services', ['secretary_theme_slug' => $secretary->theme_slug, 'service_slug' => $service->name_slug]) }}" class="bloco--servico">
                                        <div class="icone">
                                            <img src="{{ asset('images/web/service/default.svg') }}" alt="Serviços secretaria">
                                        </div>
                                        <div class="titulo--subtitulo">
                                            <span class="titulo">{{ $service->name }}</span>
                                            <span class="subtitulo">{{ $service->description }}</span> 
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>
                </section>
            @else
                <div class="bloco--secretaria--sem--servicos">
                    <div class="titulo--ops">Ooops!</div>
                    <div class="descricao">A secretaria informada ainda não possui serviços cadastrados</div>
                </div>
            @endif
        </section>
    </main>
@endsection

@section('styles')
    <style>
        @font-face {
            font-family: 'Product Sans Black';
            src: url("{{ asset('fonts/product_sans_black.woff') }}");
        }
        @font-face {
            font-family: 'Product Sans Medium';
            src: url("{{ asset('fonts/product_sans_medium.woff') }}");
        }

        .bloco--secretaria {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        .bloco--secretaria > .titulo {
            height: 45px;
            line-height: 45px;
            margin-top: 20px;
            display: block;
            padding-left: 15px;
            font-family: 'Product Sans Black', sans-serif;
            text-shadow: 1px 1px 2px black; 
            font-size: 28px;
            word-spacing: 5px;
            background-image: linear-gradient(to right, #293F6B 90%, #C5D4EB 0%);
            color: #FFFFFF;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .bloco--secretaria > .conteudo {
            margin-top: 30px;
        }
        .bloco--secretaria--sem--servicos {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .bloco--secretaria--sem--servicos > .titulo--ops {
            font-family: 'Product Sans Black', sans-serif;
            font-size: 80px;
            color: #293F6B;
            text-align: center;
        }
        .bloco--secretaria--sem--servicos > .descricao {
            font-family: 'Product Sans Medium', sans-serif;
            font-size: 30px;
            color: #293F6B;
            text-align: center;
        }

        .conteudo > fieldset {
            border-radius: 5px;
            border: 1px solid #293F6B;
        }
        .conteudo > fieldset > legend {
            font-family: 'Product Sans Medium';
            font-size: 20px;
            word-spacing: 4px;
            color:#293F6B;
        }

        /* BLOCO SERVIÇO */
        .bloco--geral--servicos {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .bloco--servico {
            width: 21%;
            margin: 10px 0px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #F8F8F8;
            border-radius: 2px;
            box-shadow: 0 3px 6px 0 rgba(0,0,0,.16);
            transition: box-shadow 0.5s;
        }
        .bloco--servico:hover {
            background-color: #C5D4EB;
            box-shadow: 1px 3px 20px #777;
        }
        .bloco--servico > .icone {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .bloco--servico > .titulo--subtitulo {
            width: 95%;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .titulo--subtitulo > .titulo {
            font-family: 'Product Sans Medium';
            font-size: 20px;
            margin-top: 10px;
            color:#293F6B;
        }
        .titulo--subtitulo > .subtitulo {
            font-size: 14px;
            color:#666666;
        }

        /* NOTEBOOK */
        @media screen and (min-width:767px) and (max-width:1100px) {
            .bloco--servico {
                width: 42%;
            }
        }

        /* TABLET */
        @media screen and (min-width:500px) and (max-width:766px) {
            .bloco--servico {
                width: 100%;
            } 
        }

        /* SMARTPHONE */
        @media screen and (min-width: 0px) and (max-width: 499px) {
            .bloco--secretaria > .titulo {
                display: block;
                height: 45px;
                line-height: 45px;
                font-size: 25px;
            }
            .bloco--geral--servicos {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .bloco--servico {
                width: 95%;
                padding: 10px 0px;
            }
            .bloco--servico > .titulo--subtitulo {
                width: 90%;
            }
        }
    </style>
@endsection
