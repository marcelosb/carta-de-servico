<!DOCTYPE html>
<html lang="pt-br">
	<head>
        <title>Login</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Carta de Serviços - Prefeitura Municipal de São Bento</title>
		<meta name="description" content="A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.">
		<meta name="robots" content="noindex, nofollow">
		{!! favicon() !!}
    
		<link rel="stylesheet" href="{{ url(asset('css/admin/bootstrap.min.css')) }}">

		@hasSection('styles')
			@yield('styles')
		@endif
		
	</head>
	<body>
        <main>
			@yield('content')
		</main>
		
		<script src="{{ url(asset('js/admin/bootstrap.min.js')) }}"></script>
		
		@hasSection('scripts')
			@yield('scripts')
		@endif
	</body>
</html>