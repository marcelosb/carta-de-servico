@extends('admin.auth.layouts.master')

@section('content') 
    <div class="bloco--flex">
        <div class="container--form border border-1 rounded">

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

            <form method="POST" action="{{ route('password.email') }}">
               {{-- TÍTULO DO FORMLÁRIO --}}
                <header class="text-secondary">
                    <h3>Esqueci minha senha</h3>
                </header>

                {{-- DESCRIÇÃO DO FORMLÁRIO --}}
                <div class="mb-3">
                    Informe o seu endereço de e-mail que está associado a sua conta de usuário.
                    Será enviada uma nova definição de senha para o seu e-mail.
                </div>

                 {{-- CAMPO OCULTO DO CSRF --}}
                 @csrf

                 {{-- CAMPO EMAIL --}}
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Digite o seu e-mail" required>
                </div>  
                
                {{-- BOTÕES DE VOLTAR E RECUPERAR SENHA --}}
                <div class="grupo--buttons">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary bg-white text-primary mx-3">Voltar</a>
                    <button type="submit" class="btn btn-primary">Recuperar senha</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/auth/forgot-password.css') }}">
@endsection
