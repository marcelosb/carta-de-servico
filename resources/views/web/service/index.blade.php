@extends('web.layouts.master')

@section('content')
    <main style="background-color:#FFFFFF; width:100vw;">
        <section class="wrapper">
            <div class="bloco--geral--servico">
                <main class="bloco--faq--servico">
                    <header>
                        <div class="breadcrumb--servico">
                            <a href="{{ route('web.home') }}">Início</a> /
                            <a href="{{ route('web.secretary', $secretary->theme_slug) }}">{{ $secretary->theme }}</a> /
                            <span>{{ $service->name }}</span>
                        </div>
                        <div class="titulo">{{ $secretary->theme }}</div>
                        <div class="subtitulo">{{ $service->name }}</div>
                        <div class="line"></div>
                    </header>
                    <div class="conteudo">
                        {!! $service->content !!}
                    </div>
                </main>
                <aside class="bloco--lateral">
                    <header>
                        <div class="titulo">
                            <img src="{{ asset('images/web/service/info.svg') }}" alt="Informações da Secretaria">
                            <span>ÓRGÃO RESPONSÁVEL</span>
                        </div>
                        <span>{{ $secretary->name }}</span>
                    </header>
                    <line></line> 
                    <div class="conteudo">
                        <div class="info">
                            <img src="{{ asset('images/web/service/phone_black.svg') }}" alt="Telefone">
                            <span>{{ $secretary->telephone }}</span>
                        </div>
                        <div class="info">
                            <img src="{{ asset('images/web/service/email.svg') }}" alt="Email">
                            <span>{{ $secretary->email }}</span>
                        </div>
                        <div class="info">
                            <img src="{{ asset('images/web/service/local_black.svg') }}" alt="Endereço">
                            <span>{{ $secretary->address }}</span>
                        </div>
                        <div class="info">
                            <img src="{{ asset('images/web/service/watch.svg') }}" alt="Horário de atendimento">
                            <span>{{ $secretary->opening_hours }}</span>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>   
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/web/service.css') }}">
@endsection
