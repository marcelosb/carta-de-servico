@extends('admin.auth.layouts.master')

@section('content') 
    <div class="bloco-flex">
        <div class="bloco-login">

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="bloco-logo">{!! logo('login') !!}</div>
            <div>
                <form method="POST" action="">
                    {{-- CAMPO OCULTO CSRF --}}
                    @csrf

                    {{-- CAMPO EMAIL --}}
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="floatingInput" placeholder="Email" value="{{ old('email') }}" autofocus required>
                        <label for="floatingInput">Email</label>
                    </div>

                    {{-- CAMPO SENHA --}}
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Senha" required>
                        <label for="floatingPassword">Senha</label>
                    </div>

                    {{-- BOTÃO DE ENTRAR NO SISTEMA --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">ENTRAR</button>
                    </div>
                </form>
            </div>

            {{-- LINK PARA RECUPERAR A SENHA --}}
            <div class="text-center mt-4">
                <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">Esqueci minha senha</a>
            </div>
            
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/auth/login.css') }}">
@endsection
