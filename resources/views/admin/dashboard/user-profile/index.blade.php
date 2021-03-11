@extends('admin.dashboard.layouts.master')

@section('content')

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="border rounded bg-white p-4">
        {{-- TÍTULO --}}
        <h2 class="mb-4">Meus dados</h2>
        <hr>

        {{-- CAMPO DE LEITURA AVATAR (IMAGEM) --}}
        <div class="d-flex mb-3">
            <div>
                @if($user->avatar === 'default')
                    <svg xmlns="http://www.w3.org/2000/svg" width="100px" height="100px" viewBox="0 0 24 24">
                        <path fill="none" d="M0 0h24v24H0V0z"/>
                        <path stroke-width="1" stroke="#F5F5F5" fill="#242939;" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                    </svg>
                @else
                    <img class="rounded-circle" src="{{ asset($user->avatar) }}" alt="Avatar" width="100px" height="100px">
                @endif
            </div>
            <div class="mx-3 d-flex flex-column align-items-start">
                <h4 style="margin-top: 5px;">{{ $user->name }}</h4>
                <span style="margin-top: -10px;">{{ $user->email }}</span>
            </div>
        </div>

        {{-- CAMPO DE LEITURA NOME --}}
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" value="{{ $user->name }}" readonly>
        </div>

        {{-- CAMPO DE LEITURA EMAIL --}}
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
        </div>

        {{-- CAMPO DE LEITURA PERFIL --}}
        <div class="mb-3">
            <label for="roleUser" class="form-label">Perfil</label>
            <input type="text" class="form-control" id="roleUser" value="{{ $role }}" readonly>
        </div>

        {{-- BOTÕES DE ALTERAR SENHA E ALTERAR DADOS --}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
            <a href="{{ route('dashboard.user.profile.edit.password') }}" class="btn btn-primary">Alterar senha</a>
            <a href="{{ route('dashboard.user.profile.edit') }}" class="btn btn-secondary">Alterar dados</a>
        </div>
    </div>

@endsection
