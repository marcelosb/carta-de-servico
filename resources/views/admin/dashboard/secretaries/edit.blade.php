@extends('admin.dashboard.layouts.master')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form class="border rounded bg-white p-4" method="POST" action="{{ route('dashboard.secretaries.update', $secretary->id) }}" enctype="multipart/form-data">
        {{-- TÍTULO DO FORMULÁRIO --}}
        <h2>Editar Secretaria</h2>

        {{-- CAMPO OCULTO CSRF --}}
        @csrf

        {{-- CAMPO OCULTO DE REQUISIÇÃO HTTP DO TIPO PUT --}}
        @method('PUT')
        
        {{-- CAMPO NOME --}}
        <div class="mb-3">
            <label for="secretaryNameEdit" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="secretaryNameEdit" value="{{ old('name') ?? $secretary->name }}" required focus>
        </div>

        {{-- CAMPO TEMA --}}
        <div class="mb-3">
            <label for="secretaryThemeEdit" class="form-label">Tema</label>
            <input type="text" name="theme" class="form-control" id="secretaryThemeEdit" value="{{ old('theme') ?? $secretary->theme }}" required>
        </div>

        {{-- CAMPO OCULTO SLUG DO TEMA --}}
        <input type="hidden" name="theme_slug" value="{{ old('theme') }}">

        {{-- CAMPO ENDEREÇO --}}
        <div class="mb-3">
            <label for="secretaryAddressEdit" class="form-label">Endereço</label>
            <input type="text" name="address" class="form-control" id="secretaryAddressEdit" value="{{ old('address') ?? $secretary->address }}" required>
        </div>

        {{-- CAMPO TLELEFONE --}}
        <div class="mb-3">
            <label for="secretaryTelephoneEdit" class="form-label">Telefone</label>
            <input type="text" name="telephone" class="form-control" id="secretaryTelephoneEdit" value="{{ old('telephone') ?? $secretary->telephone }}" required>
        </div>

        {{-- CAMPO EMAIL --}}
        <div class="mb-3">
            <label for="secretaryEmailEdit" class="form-label">Email (Opcional)</label>
            <input type="text" name="email" class="form-control" id="secretaryEmailEdit" value="{{ old('email') ?? $secretary->email }}">
        </div>

        {{-- CAMPO HORÁRIO DE ATENDIMENTO --}}
        <div class="mb-3">
            <label for="secretaryOpeningHoursEdit" class="form-label">Horário de Atendimento</label>
            <input type="text" name="opening_hours" class="form-control" id="secretaryOpeningHoursEdit" value="{{ old('opening_hours') ?? $secretary->opening_hours }}" required>
        </div>

        {{-- CAMPO UPLOAD DE ARQUIVO (ÍCONE DA SECRETARIA) --}}
        <div class="border rounded bg-white p-4 mb-4">
            <div class="mb-3">
                <label for="iconSecretary" class="form-label">Ícone da secretaria (Opcional)</label>
                <input 
                    type="file" 
                    name="icon"
                    class="form-control"
                    id="iconSecretary"
                    value="{{ $secretary->icon }}"
                    accept="image/png, image/jpg, image/jpeg"
                >
            </div>
            <div class="mb-3 ">
                <label for="caminhoDoAvatar" class="form-label">Ícone atual</label><br>
                @if($secretary->icon === 'default')
                    <img src="{{ asset('images/web/secretary/icons/default.svg') }}" width="100px" height="100px" alt="Ícone padrão" id="iconDefault">
                @else
                    <img src="{{ asset($secretary->icon) }}" width="100px" height="100px" alt="Avatar" id="iconCurrent">
                @endif
            </div>
        </div>

        {{-- CAMPO OCULTO CAMINHO DO ÍCONE ANTIGO DA SECRETARIA --}}
        <input type="hidden" name="icon_path_old" value="{{ $secretary->icon }}">

        {{-- BOTÕES DE EDITAR E VOLTAR --}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Editar</button>
            <a href="{{ route('dashboard.secretaries.index') }}" class="btn bg-white border-primary text-primary">Voltar</a>
        </div>
    </form>

@endsection

@section('scripts')
    <script>
        const iconSecretary = document.getElementById('iconSecretary');
        iconSecretary.addEventListener('change', function(event) {
            const fileIcon = event.target.files[0];

            const reader = new FileReader();
            reader.addEventListener('load', (event) => {
                const iconCurrent = document.getElementById('iconCurrent');
                if (iconCurrent) {
                    iconCurrent.src = event.target.result;
                }

                const iconDefault = document.getElementById('iconDefault');
                if (iconDefault) {
                    iconDefault.src = event.target.result;
                }
            });
            reader.readAsDataURL(fileIcon);
        });
    </script>
@endsection