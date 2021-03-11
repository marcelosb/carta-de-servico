<!DOCTYPE html>
<html lang="pt-br" translate="no">
    <head>

        {!! SEOMeta::generate() !!}
        {!! OpenGraph::generate() !!}
        {!! Twitter::generate() !!}
        {!! favicon() !!}

        {{-- 
            <link rel="stylesheet" href="{{ asset('css/web/all.css') }}">
            <link rel="stylesheet" href="{{ asset('css/web/header.css') }}">
            <link rel="stylesheet" href="{{ asset('css/web/footer.css') }}"> 
        --}}

        {{-- JUNÇÃO E MINIFICAÇÃO DOS ARQUIVOS ALL, HEADER E FOOTER.CSS  --}}
        <link rel="stylesheet" href="{{ asset('css/web/web.min.css') }}">

        @hasSection('styles')
			@yield('styles')
		@endif

    </head>
    <body>

        {{-- CABAÇALHO DO SITE --}}
        <header>
            @include('web.layouts.partials.header')
        </header>

        {{-- CONTEÚDO DINÂMICO DO SITE --}}
        <main style="width: 100vw;">
            @yield('content')
        </main>

        {{-- RODAPÉ DO SITE --}}
        <footer>
            @include('web.layouts.partials.footer')
        </footer>

        <script src="{{ asset('js/web/footer.js') }}"></script>
        <script src="{{ asset('js/web/home.js') }}"></script>
        <script src="{{ asset('js/web/menu-mobile.js') }}"></script>
        
    </body>
</html>