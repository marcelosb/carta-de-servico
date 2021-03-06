@extends('admin.dashboard.layouts.master')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form class="border rounded bg-white p-4" method="POST" action="{{ route('dashboard.roles.update', $role->id) }}">
        {{-- TÍTULO DO FORMULÁRIO --}}
        <h2>Editar Perfil</h2>

        {{-- CAMPO OCULTO DO CSRF --}}
        @csrf

        {{-- CAMPO OCULTO DO TIPO REQUISIÇÃO HTTP PUT --}}
        @method('PUT')

        {{-- CAMPO NOME --}}
        <div class="mb-3">
            <label for="roleName" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="roleName" value="{{ $role->name }}" required>
        </div>

        {{-- CAMPO EMAIL --}}
        <div class="mb-3">
            <label for="roleDescription" class="form-label">Descrição</label>
            <input type="text" name="description" class="form-control" id="roleDescription" value="{{ $role->description }}" required>
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
            @foreach(config('permissions.name') as $permissionCode => $permissionName)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permissionCode }}" id="{{ $permissionCode }}" onClick="checkPermission(this)"
                        @if(is_array(old('permission')) && in_array($permissionName, old('permission'))) 
                            checked 
                        @endif      
                    >
                    <label class="form-check-label" for="{{ $permissionCode }}">
                        {{ $permissionName }}
                    </label>
                </div>
            @endforeach
            <hr>
        <div>
    
        {{-- BOTÕES DE EDITAR E VOLTAR --}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Editar</button>
            <a href="{{ route('dashboard.roles.index') }}" class="btn bg-white border-primary text-primary">Voltar</a>
        </div>
    </form>

@endsection

@section('scripts')
    <script>

        function isCheckedPermissionUser() {
            const permissions = document.querySelectorAll('input[name="permission[]"]');
            const codes = {!! json_encode($codes) !!};

            permissions.forEach(function(element) {
                codes.forEach(function(code) {
                    if (code === element.value) {
                        element.checked = true;
                    }
                });
            });   
        }

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

        isCheckedPermissionUser();

    </script>
@endsection
