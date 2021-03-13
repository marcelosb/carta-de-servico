@extends('admin.dashboard.layouts.master')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form class="border rounded bg-white p-4" method="POST" action="{{ route('dashboard.user.profile.update') }}" enctype="multipart/form-data">
        {{-- TÍTULO DO FORMULÁRIO --}}
        <h2 class="mb-3">Alterar meus dados</h2>
    
        {{-- CAMPO OCULTO CSRF --}}
        @csrf

        {{-- CAMPO OCULTO DE REQUISIÇÃO HTTP DO TIPO PUT --}}
        @method('PUT')

        {{-- CAMPO UPLOAD DE ARQUIVO (AVATAR IMAGEM) --}}
        <div class="border rounded bg-white p-4 mb-4">
            <div class="mb-3">
                <label for="imageAvatar" class="form-label">Alterar o avatar</label>
                <input 
                    type="file" 
                    name="avatar"
                    class="form-control"
                    id="imageAvatar"
                    value="{{ $user->avatar }}"
                    accept="image/png, image/jpg, image/jpeg"
                >
            </div>
            <div class="mb-3">
                <label for="caminhoDoAvatar" class="form-label">Avatar atual</label><br>
                @if($user->avatar === 'default')
                    <a data-fslightbox="gallery" href="{{ asset('images/avatar.svg') }}">
                        <img src="{{ asset('images/avatar.svg') }}" width="100px" height="100px" alt="Avatar padrão" id="avatarDefault">
                    </a>
                @else
                    <a data-fslightbox="gallery" href="{{ asset($user->avatar) }}">
                        <img class="rounded-circle" src="{{ asset($user->avatar) }}" width="100px" height="100px" alt="Avatar" id="avatarCurrent">
                    </a>
                @endif
            </div>
        </div>

        {{-- CAMPO NOME --}}
        <div class="mb-3">
            <label for="userProfileNameEdit" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="userProfileNameEdit" value="{{ old('name') ?? $user->name }}" required autofocus>
        </div>

        {{-- CAMPO EMAIL --}}
        <div class="mb-3">
            <label for="userProfileEmailEdit" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" id="userProfileEmailEdit" value="{{ old('email') ?? $user->email }}" required>
        </div>
    
        {{-- CAMPO OCULTO ID --}}
        <input type="hidden" name="id" value="{{ $user->id }}">

        {{-- CAMPO OCULTO CAMINHO ANTIGO DO AVATAR (IMAGEM) --}}
        <input type="hidden" name="avatar_path_old" value="{{ $user->avatar }}">

        {{-- BOTÕES DE ALTERAR E CANCELAR --}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-secondary">Alterar</button>
            <a href="{{ route('dashboard.user.profile.index') }}" class="btn bg-white border-secondary text-secondary">Cancelar</a>
        </div>
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin/dashboard/fslightbox.js') }}"></script>

    <script>
        const imageAvatar = document.getElementById('imageAvatar');
        imageAvatar.addEventListener('change', function(event) {
            const fileIAvatar = event.target.files[0];

            const reader = new FileReader();
            reader.addEventListener('load', (event) => {
                const avatarCurrent = document.getElementById('avatarCurrent');
                if (avatarCurrent) {
                    avatarCurrent.src = event.target.result;
                }
                const avatarDefault = document.getElementById('avatarDefault');
                if (avatarDefault) {
                    avatarDefault.src = event.target.result;
                }
            });

            reader.readAsDataURL(fileIAvatar);
        });

        const linkAvatarLigthBox = document.querySelector('[data-fslightbox="gallery"]');
        linkAvatarLigthBox.addEventListener('click', function() {
            const avatarLigthBox = document.querySelector('[class="fslightbox-source fslightbox-opacity-1"]');
            if (avatarLigthBox) {
                const avatarCurrent = document.getElementById('avatarCurrent');
                avatarLigthBox.src = avatarCurrent.src;
            }
        });

    </script>
    
@endsection
