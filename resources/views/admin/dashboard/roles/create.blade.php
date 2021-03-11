@extends('admin.dashboard.layouts.master')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form class="border rounded bg-white p-4" method="POST" action="{{ route('dashboard.roles.store') }}">
        {{-- TÍTULO DO FORMULÁRIO --}}
        <h2>Cadastrar Perfil</h2>

        {{-- CAMPO OCULTO CSRF --}}
        @csrf

        {{-- CAMPO NOME --}}
        <div class="mb-3">
            <label for="namePermission" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="namePermission" value="{{ old('name') }}" required focus>
        </div>

        {{-- CAMPO DESCRIÇÃO --}}
        <div class="mb-3">
            <label for="descriptionPermission" class="form-label">Descrição</label>
            <input type="text" name="description" class="form-control" id="descriptionPermission" value="{{ old('description') }}" required focus>
        </div>

        {{-- PERMISSÕES --}}
        <div class="mb-3">
            <h2>Permissões</h2>
            <hr>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="select all" id="checkSelectAll" onClick="activeAllPermissions(this)">
                <label class="form-check-label" for="checkSelectAll">Selecionar todos os privilégios</label>
            </div>
            <hr>
            @foreach(config('permissions.name') as $key => $value)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $key }}" id="{{ $key }}" onClick="checkPermission(this)"
                        @if(is_array(old('permission')) && in_array($value, old('permission'))) 
                            checked 
                        @endif
                    >
                    <label class="form-check-label" for="{{ $key }}">
                        {{ $value }}
                    </label>
                </div>
            @endforeach
            <hr>
        </div>
       
        {{-- BOTÕES DE CADASTRAR E VOLTAR --}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="{{ route('dashboard.roles.index') }}" class="btn bg-white border-primary text-primary">Voltar</a>
        </div>
    </form>

@endsection

@section('scripts')
    <script>

        function activeAllPermissions(elementSelectAll) {
            const permissions = document.querySelectorAll('[type="checkbox"]');
            permissions.forEach(function(permission) {
                if (permission !== elementSelectAll) {
                    permission.checked = elementSelectAll.checked;
                }
            });
        }

        function checkPermission(permission) {
            const selectAll = document.getElementById('checkSelectAll');
            if (permission.checked === false) {
                selectAll.checked = permission.checked;
            }
        }

    </script>
@endsection
