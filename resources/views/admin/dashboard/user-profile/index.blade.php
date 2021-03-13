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
                    <img src="{{ asset('images/avatar.svg') }}" width="100px" height="100px" alt="Avatar padrão" id="avatarDefault">
                @else
                    <a data-fslightbox="gallery" href="{{ asset($user->avatar) }}">
                        <img class="rounded-circle" src="{{ asset($user->avatar) }}" alt="Avatar" width="100px" height="100px">
                    </a>
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

@section('scripts')
    <script src="{{ asset('js/admin/dashboard/fslightbox.js') }}"></script>
@endsection
