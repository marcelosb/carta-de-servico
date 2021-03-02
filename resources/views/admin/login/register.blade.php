@extends('admin.layouts.login')

@section('content') 
    <h2 class="text-center mt-4">Administrador do Sistema</h2>
    <form class="border rounded bg-white p-5 mt-4 mx-4" method="POST" action="">

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @csrf
        
        {{-- CAMPO NOME --}}
        <div class="mb-3">
            <label for="user" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="user" value="{{ old('name') }}" required autofocus>
        </div>

        {{-- CAMPO EMAIL --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control text-lowercase" value="{{ old('email') }}" id="email" required>
        </div>

         {{-- PERMISSÕES --}}
         <div class="mb-3">
            <h2>Permissões</h2>
            <hr>
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="{{ $permission->id }}" onClick="checkPermission(this)" checked>
                    <label class="form-check-label" for="{{ $permission->id }}">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
            <hr>
        </div>

        {{-- CAMPO SENHA --}}
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>

        {{-- CAMPO CONFIRMAR SENHA --}}
        <div class="mb-3">
            <label for="passwordConfirmation" class="form-label">Confirmar senha</label>
            <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation" required>
        </div>

        {{-- BOTÕES DE CADASTRAR E VOLTAR --}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="{{ route('login') }}" class="btn bg-white border-primary text-primary">Voltar</a>
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
