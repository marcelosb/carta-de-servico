@extends('admin.layouts.login')

@section('content') 
    <div class="bloco-flex">
        <div class="bloco-login">

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="bloco-logo">{!! logo('login') !!}</div>
            <div>
                <form method="POST" action="">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="floatingInput" placeholder="Email" value="{{ old('email') }}" autofocus required>
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Senha" required>
                        <label for="floatingPassword">Senha</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">ENTRAR</button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">Esqueci minha senha</a>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('register') }}" class="text-primary">Registrar novo usuário</a>
            </div>
            
        </div>
    </div>
@endsection
