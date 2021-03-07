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

        {{-- CAMPO SELEÇÃO DE PERFIL --}}
        <div class="my-3">
            <label for="userEmail" class="form-label">Perfil</label>
            <select class="form-select" name="role_id" autofocus>
                <option>Selecione</option>
                @foreach ($roles as $role)
                    @if($role->id === $roleId)
                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                    @else
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    
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
