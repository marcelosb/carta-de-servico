
@extends('admin.layouts.dashboard')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form class="border rounded bg-white p-4" method="POST" action="{{ route('dashboard.users.store') }}">
        {{-- TÍTUO DO FORMULÁRIO --}}
        <h2>Cadastrar Usuário</h2>

        {{-- CAMPO OCULTO DO CSRF --}}
        @csrf

        {{-- CAMPO NOME --}}
        <div class="mb-3">
            <label for="userName" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="userName" value="{{ old('name') }}" required autofocus>
        </div>

        {{-- CAMPO EMAIL --}}
        <div class="mb-3">
            <label for="userEmail" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="userEmail" value="{{ old('email') }}" required>
        </div>

        {{-- PERFIS --}}
        <div class="my-3">
            <label for="role" class="form-label">Perfil</label>
            <select class="form-select" name="role_id" id="role" autofocus>
                <option selected>Selecione</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old("role_id") == $role->id ? "selected" : "" }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- PERMISSÕES --}}
        {{-- <div class="mb-3">
            <h2>Permissões</h2>
            <hr>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="select all" id="checkSelectAll" onClick="activeAllPermissions(this)">
                <label class="form-check-label" for="checkSelectAll">Selecionar todos os privilégios</label>
            </div>
            <hr>
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="{{ $permission->id }}" onClick="checkPermission(this)"
                        @if(is_array(old('permission')) && in_array($permission->name, old('permission'))) 
                            checked 
                        @endif
                    >
                    <label class="form-check-label" for="{{ $permission->id }}">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
            <hr>
        </div> --}}
    
        {{-- CAMPO SENHA --}}
        <div class="mb-3">
            <label for="userPassword" class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" id="userPassword" required>
        </div>
    
        {{-- CAMPO CONFIRMAR SENHA --}}
        <div class="mb-3">
            <label for="passwordConfirmation" class="form-label">Confirmar senha</label>
            <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation" required>
        </div>
    
        {{-- BOTÕES DE CADASTRAR E VOLTAR --}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="{{ route('dashboard.users.index') }}" class="btn bg-white border-primary text-primary">Voltar</a>
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
