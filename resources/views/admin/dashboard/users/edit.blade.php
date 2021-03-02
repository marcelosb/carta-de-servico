@extends('admin.layouts.dashboard')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form class="border rounded bg-white p-4" method="POST" action="{{ route('dashboard.users.update', $user->id) }}">
        {{-- TÍTULO DO FORMULÁRIO --}}
        <h2>Editar Usuário</h2>

        {{-- CAMPO OCULTO DO CSRF --}}
        @csrf

        {{-- CAMPO OCULTO DO TIPO DO MÉTODO HTTP --}}
        @method('PUT')

        {{-- CAMPO NOME --}}
        <div class="mb-3">
            <label for="userName" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="userName" value="{{ $user->name }}" readonly>
        </div>

        {{-- CAMPO EMAIL --}}
        <div class="mb-3">
            <label for="userEmail" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="userEmail" value="{{ $user->email }}" readonly>
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
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="{{ $permission->id }}" onClick="checkPermission(this)"
                        @if(is_array(old('permission')) && in_array($permission->name, old('permission'))) 
                            checked 
                        @else
                            {{ isCheckedPermissionUser($permission->name, $userPermissions) }}
                        @endif
                    >
                    <label class="form-check-label" for="{{ $permission->id }}">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
            <hr>
        <div>
    
        {{-- BOTÕES DE EDITAR E VOLTAR --}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Editar</button>
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
