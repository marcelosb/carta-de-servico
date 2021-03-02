@extends('admin.layouts.dashboard')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form class="border rounded bg-white p-4" method="POST" action="{{ route('dashboard.user.profile.update.password') }}">
        <h2 class="mb-3">Alterar senha</h2>

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="userProfilePasswordCurrentEdit" class="form-label">Senha atual</label>
            <input type="password" name="password_current" class="form-control" id="userProfilePasswordCurrentEdit" value="{{ old('password_current') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label for="userProfileNewPasswordEdit" class="form-label">Nova senha</label>
            <input type="password" name="new_password" class="form-control" id="userProfileNewPasswordEdit" required>
        </div>
        <div class="mb-3">
            <label for="userProfilePasswordConfirmEdit" class="form-label">Confirmar senha</label>
            <input type="password" name="new_password_confirmation" class="form-control" id="userProfilePasswordConfirmEdit" required>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Alterar senha</button>
            <a href="{{ route('dashboard.user.profile.index') }}" class="btn bg-white border-primary text-primary">Cancelar</a>
        </div>
    </form>

@endsection