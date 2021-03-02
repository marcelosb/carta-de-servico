@extends('admin.layouts.dashboard')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Atenção:</strong> ao cadastrar uma nova permissão, tente seguir o padrão (visualizar,
        editar, criar e deletar). Por exemplo: criar usuário, editar usuário e assim sucessivamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <form class="border rounded bg-white p-4" method="POST" action="{{ route('dashboard.permissions.update', $permission->id) }}">
        <h2>Editar Permissão</h2>

        @csrf
        @method('PUT')

        {{-- CAMPO NOME --}}
        <div class="mb-3">
            <label for="namePermission" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="namePermission" value="{{ old('name') ?? $permission->name }}" required focus>
        </div>
       
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Editar</button>
            <a href="{{ route('dashboard.permissions.index') }}" class="btn bg-white border-primary text-primary">Voltar</a>
        </div>
    </form>

@endsection

@section('scripts')
    
@endsection
