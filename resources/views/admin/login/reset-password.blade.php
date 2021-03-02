@extends('admin.layouts.login')

@section('content') 
    <div class="bloco--flex">
        <div class="container--form border border-1 rounded">

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                
                {{-- TÍULO DO FORMULÁRIO --}}
                <header class="text-secondary text-center bold">
                    <h3><strong>Criar nova senha</strong></h3>
                </header>

                {{-- CAMPO OCULTO DO CSRF --}}
                @csrf

                {{-- CAMPO EMAIL --}}
                <div class="mb-3">
                    <label for="emailCurrent" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="emailCurrent" value="{{ $request->email }}" required readonly>
                </div> 

                {{-- CAMPO NOVA SENHA --}}
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Nova senha</label>
                    <input type="password" name="password" class="form-control" id="newPassword" required autofocus>
                </div>  

                {{-- CAMPO CONFIRMAR NOVA SENHA --}}
                <div class="mb-3">
                    <label for="confirmationNewPassword" class="form-label">Confirmar nova senha</label>
                    <input type="password" name="password_confirmation" class="form-control" id="confirmationNewPassword" required>
                </div>

                {{-- CAMPO OCULTO DO TOKEN --}}
                <input type="hidden" name="token" value="{{ request()->route('token') }}">    

                {{-- BOTÕES DE VOLTAR E ALTERAR SENHA --}}
                <div class="grupo--buttons">
                    <a href="{{  route('login') }}" class="btn btn-outline-primary bg-white text-primary mx-3">Voltar</a>
                    <button type="submit" class="btn btn-primary">Alterar senha</button>
                </div>

            </form>

        </div>
    </div>
@endsection

@section('styles')
    <style>
        .bloco--flex {
            width: 100vw;
            height: 100vh;
            padding: 20px;
            background-color: #F2F2F2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .bloco--flex > .container--form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #FFFFFF;
            width: 600px;
            padding: 40px;
        }
        header > h3 {
            font-weight:300;
        }
        .grupo--buttons {
            display: flex;
            justify-content: flex-end;
        }

        @media screen and (min-width:0px) and (max-width:700px) {
            .bloco--flex {
                padding: 20px;
            }
            .bloco--flex > .container--form {
                width: 100%;
                padding: 40px;
            }
            header > h3 {
                color: #000000 !important;
                font-size: 20px !important;
                font-weight:500;
            }
            header + div {
                margin-top: 15px !important;
                font-size: 15px !important;
            }
            .grupo--buttons {
                flex-direction: column-reverse;
            }
            .grupo--buttons > a {
                margin: 10px 0px 0px 0px !important;
            }
        }
    </style>
@endsection