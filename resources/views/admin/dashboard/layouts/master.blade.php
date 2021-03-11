<!DOCTYPE html>
<html lang="pt-br" translate="no">
    <head>
		<title>Painel de Controle</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Carta de Serviços - Prefeitura Municipal de São Bento</title>
		<meta name="description" content="A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.">
		<meta name="robots" content="noindex, nofollow">
		{!! favicon() !!}

        <link rel="stylesheet" href="{{ asset('css/admin/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin/dashboard/dashboard.css') }}">
		
		@hasSection('styles')
			@yield('styles')
		@endif

    </head>
    <body>

	    <section class="dashboard--painel">
			{{-- BARRA LATERAL (LADO ESQUERDO) --}}
			<aside id="barraLateral" class="barra--lateral">
				@include('admin.dashboard.layouts.partials.sidebar')
			</aside>

			{{-- CABEÇALHO DO PAINEL DE CONTROLE E CONTEÚDO --}}
			<main class="main--conteudo">
				<header>
					@include('admin.dashboard.layouts.partials.header')
				</header>
				<main id="content">
                    @yield('content')
				</main>
			</main>
		</section>

		<div class="bloco--cinza--transparente" style="display:none;"></div>

		<script src="{{ asset('js/popper.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/template.js') }}"></script>

		@hasSection('scripts')
			@yield('scripts')
		@endif

    </body>

</html>
