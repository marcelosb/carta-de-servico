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
            @forelse($secretaries as $secretary)
                <a class="bloco" href="{{ route('web.secretary', $secretary->theme_slug) }}">
                    @if($secretary->icon === 'default')
                        <img src="{{ asset('images/web/secretary/icons/default.svg') }}" alt="Ícone {{ $secretary->theme }}">
                    @else
                        <img src="{{ asset($secretary->icon) }}" alt="Ícone {{ $secretary->theme }}">
                    @endif
                     
                    <h1>{{ $secretary->theme }}</h1>
                </a>
            @empty
                <div class="container--secretary--empty">
                    <div class="title--ops">Ooops!</div>
                    <div class="description">Não existem secretarias cadastradas no sistema</div>
                </div>
            @endforelse
        </div>
    </section>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/web/home.css') }}">
@endsection
