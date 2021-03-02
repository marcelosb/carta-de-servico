<!DOCTYPE html>
<html lang="pt-br">
	<head>
        <title>Login</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Carta de Serviços - Prefeitura Municipal de São Bento</title>
		<meta name="description" content="A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.">
		<meta name="robots" content="noindex, nofollow">
    
		<link rel="stylesheet" href="{{ url(asset('/css/bootstrap.min.css')) }}">
		<link rel="stylesheet" href="{{ url(asset('/css/login.css')) }}">

		{!! favicon() !!}

		@hasSection('styles')
			@yield('styles')
		@endif
		
	</head>
	<body>
        <main>
			@yield('content')
		</main>
		
		<script src="{{ url(asset('/js/bootstrap.min.js')) }}"></script>
		<script src="{{ url(asset('/js/login.js')) }}"></script>
		
		@hasSection('scripts')
			@yield('scripts')
		@endif
	</body>
</html>