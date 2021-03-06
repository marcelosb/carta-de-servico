@extends('admin.dashboard.layouts.master')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form class="border rounded bg-white p-4" method="POST" action="{{ route('dashboard.secretaries.store') }}" enctype="multipart/form-data">
        {{-- TÍTULO DO FORMULÁRIO --}}
        <h2>Cadastrar Secretaria</h2>

        {{-- CAMPO OCULTO CSRF --}}
        @csrf

        {{-- CAMPO NOME --}}
        <div class="mb-3">
            <label for="nameSecretary" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="nameSecretary" value="{{ old('name') }}" required focus>
        </div>

        {{-- CAMPO TEMA --}}
        <div class="mb-3">
            <label for="themeSecretary" class="form-label">Tema</label>
            <input type="text" name="theme" class="form-control" id="themeSecretary" value="{{ old('theme') }}" required>
        </div>

        {{-- CAMPO OCULTO SLUG DO TEMA --}}
        <input type="hidden" name="theme_slug" value="">

        {{-- CAMPO ENDEREÇO --}}
        <div class="mb-3">
            <label for="addressSecretary" class="form-label">Endereço</label>
            <input type="text" name="address" class="form-control" id="addressSecretary" value="{{ old('address') }}" required>
        </div>

        {{-- CAMPO TELEFONE --}}
        <div class="mb-3">
            <label for="telephoneSecretary" class="form-label">Telefone</label>
            <input type="text" name="telephone" class="form-control" id="telephoneSecretary" value="{{ old('telephone') }}" required>
        </div>

        {{-- CAMPO EMAIL --}}
        <div class="mb-3">
            <label for="emailSecretary" class="form-label">Email (Opcional)</label>
            <input type="email" name="email" class="form-control" id="emailSecretary" value="{{ old('email') }}">
        </div>

        {{-- CAMPO HORÁRIO DE ATENDIMENTO --}}
        <div class="mb-3">
            <label for="openingHoursSecretary" class="form-label">Horário de Atendimento</label>
            <input type="text" name="opening_hours" class="form-control" id="openingHoursSecretary" value="{{ old('opening_hours') }}" required>
        </div>

        {{-- CAMPO UPLOAD DE ARQUIVO (ÍCONE DA SECRETARIA) --}}
        <div class="border rounded bg-white p-4 mb-4">
            <div class="mb-3">
                <label for="imageSecretary" class="form-label">Ícone da secretaria (Opcional)</label>
                <input type="file" name="image_secretary" class="form-control" id="imageSecretary" accept="image/png, image/jpg, image/jpeg">
            </div>
        </div>

        {{-- BOTÕES DE CADASTRAR E VOLTAR --}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="{{ route('dashboard.secretaries.index') }}" class="btn bg-white border-primary text-primary">Voltar</a>
        </div>
    </form>
@endsection
