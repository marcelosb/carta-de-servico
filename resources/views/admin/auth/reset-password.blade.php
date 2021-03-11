@extends('admin.auth.layouts.master')

@section('content') 
    <div class="bloco--flex">
        <div class="container--form border border-1 rounded">

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                {{-- TÍULO DO FORMULÁRIO --}}
                <header class="text-secondary text-center bold">
                    <h3><strong>Criar nova senha</strong></h3>
                </header>

                {{-- CAMPO OCULTO DO CSRF --}}
                @csrf

                {{-- CAMPO EMAIL --}}
                <div class="mb-3">
                    <label for="emailCurrent" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="emailCurrent" value="{{ $request->email }}" required readonly>
                </div> 

                {{-- CAMPO NOVA SENHA --}}
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Nova senha</label>
                    <input type="password" name="password" class="form-control" id="newPassword" required autofocus>
                </div>  

                {{-- CAMPO CONFIRMAR NOVA SENHA --}}
                <div class="mb-3">
                    <label for="confirmationNewPassword" class="form-label">Confirmar nova senha</label>
                    <input type="password" name="password_confirmation" class="form-control" id="confirmationNewPassword" required>
                </div>

                {{-- CAMPO OCULTO DO TOKEN --}}
                <input type="hidden" name="token" value="{{ request()->route('token') }}">    

                {{-- BOTÕES DE VOLTAR E ALTERAR SENHA --}}
                <div class="grupo--buttons">
                    <a href="{{  route('login') }}" class="btn btn-outline-primary bg-white text-primary mx-3">Voltar</a>
                    <button type="submit" class="btn btn-primary">Alterar senha</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/auth/reset-password.css') }}">
@endsection
