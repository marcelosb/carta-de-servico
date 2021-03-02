@extends('admin.layouts.dashboard')

@section('content')

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form class="border rounded bg-white p-4" method="POST" action="{{ route('dashboard.faq.update') }}">
        {{-- TÍTULO DO FORMULÁRIO --}}
        <h2 class="mb-4">Perguntas frequentes</h2>
        
        @csrf
        @method('PUT')

        {{-- CAMPO TÍTULO --}}
        <div class="mb-3">
            <label for="faqTitle" class="form-label">Título</label>
            <input type="text" name="title" class="form-control" id="faqTitle" value="{{ old('title') ?? $faq->title }}" required>
        </div>

        {{-- CAMPO CONTEÚDO --}}
        <div class="mb-3">
            <label for="faqContent" class="form-label">Conteúdo</label>
            <textarea name="content" class="form-control" id="faqContent">
                {{ old('content') ?? $faq->content }} 
            </textarea>
        </div>

        {{-- CAMPO OCULTO COM O ID DAS PERGUNTAS FREQUENTES --}}
        <input type="hidden" name="faq_id" value="{{ $faq->id }}">

        {{-- BOTÕES DE SALVAR E CANCELAR --}}
        @if(hasPermission('editar perguntas frequentes'))
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('dashboard.home') }}" class="btn btn-secondary">Cancelar</a>  
            </div>
        @endif
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('js/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#faqContent',
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
