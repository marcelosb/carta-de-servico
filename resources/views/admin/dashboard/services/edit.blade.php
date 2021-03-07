@extends('admin.layouts.dashboard')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form class="border rounded bg-white p-4" method="POST" action="{{ route('dashboard.services.update', ['service' => $service->id]) }}">
        {{-- TÍTULO DO FORMULÁRIO --}}
        <h2 class="mb-4">Editar Serviço</h2>
        
        {{-- CAMPO OCULTO CSRF --}}
        @csrf

        {{-- CAMPO OCULTO DE REQUISIÇÃO HTTP DO TIPO PUT --}}
        @method('PUT')

        {{-- CAMPO SELECIONAR SECRETARIA --}}
        <div class="my-3">
            <select class="form-select" name="secretary_id" autofocus>
                <option>Selecione a secretaria</option>
                @foreach ($secretaries as $secretary)
                    @if($secretary->id === $service->secretary_id)
                        <option value="{{ $secretary->id }}" selected>{{ $secretary->name }}</option>
                    @else
                        <option value="{{ $secretary->id }}">{{ $secretary->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        {{-- CAMPO NOME --}}
        <div class="mb-3">
            <label for="serviceNameEdit" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="serviceNameEdit" value="{{ old('name') ?? $service->name }}" required>
        </div>

        {{-- CAMPO OCULTO SLUG NOME DO SERVIÇO --}}
        <input type="hidden" name="name_slug">

        {{-- CAMPO DESCRIÇÃO --}}
        <div class="mb-3">
            <label for="serviceDescriptionEdit" class="form-label">Descrição</label>
            <textarea name="description" class="form-control" id="serviceDescriptionEdit" required>{{ old('description') ?? $service->description }}</textarea>
        </div>

        {{-- CAMPO CONTEÚDO --}}
        <div class="mb-3">
            <label for="serviceContentEdit" class="form-label">Conteúdo</label>
            <textarea name="content" class="form-control" id="serviceContentEdit">{{ old('content') ?? $service->content }}</textarea>
        </div>

        {{-- BOTÕES DE EDITAR E VOLTAR --}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Editar</button>
            <a href="{{ route('dashboard.services.index') }}" class="btn bg-white border-primary text-primary">Voltar</a>
        </div>
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('js/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#serviceContentEdit',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help save'
            ],
            toolbar: `undo redo | styleselect fontselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify |
                        bullist numlist | link | forecolor backcolor fullscreen`,
            menubar : false,
            forced_root_block : 'div',
            language: 'pt_BR',
            content_style: `
                @font-face {
                    font-family: 'Product Sans Black';
                    src: url({{ asset('fonts/product_sans_black.woff') }});
                }
                @font-face {
                    font-family: 'Product Sans Regular';
                    src: url( {{ asset('fonts/product_sans_regular.woff') }});
                }`,
            font_formats: `
                Andale Mono=andale mono,times;
                Arial=arial,helvetica,sans-serif;
                Arial Black=arial black,avant garde;
                Book Antiqua=book antiqua,palatino;
                Comic Sans MS=comic sans ms,sans-serif;
                Courier New=courier new,courier;
                Georgia=georgia,palatino;
                Helvetica=helvetica;
                Impact=impact,chicago;
                Symbol=symbol;
                Tahoma=tahoma,arial,helvetica,sans-serif;
                Terminal=terminal,monaco;
                Times New Roman=times new roman,times;
                Trebuchet MS=trebuchet ms,geneva;
                Verdana=verdana,geneva;
                Product Sans Black=product sans black;
                Product Sans Regular=product sans regular;`
            });
    </script>
@endsection
