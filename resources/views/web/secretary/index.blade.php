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
    <link rel="stylesheet" href="{{ asset('css/web/secretary.css') }}">
@endsection
