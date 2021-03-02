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

    <form method="POST" action="{{ route('dashboard.configurations.update', $configuration->id) }}" enctype="multipart/form-data">
        <h2 class="mb-4">Configurações</h2>

        @csrf
        @method('PUT')
    
        <div class="border rounded bg-white p-4 mb-4">
            <div class="mb-3">
                <label for="webSiteTitle" class="form-label">Título do site</label>
                <input 
                    type="text" 
                    name="website_title" 
                    class="form-control" 
                    id="webSiteTitle" 
                    value="{{ old('website_title') ?? $configuration->website_title }}" 
                    required
                >
            </div>
        </div>
    
        <div class="border rounded bg-white p-4 mb-4">
            <div class="mb-3">
                <label for="logoImage" class="form-label">Alterar a logo do website</label>
                <input 
                    type="file" 
                    name="logo"
                    class="form-control"
                    id="logoImage"
                    value="{{ old('logo') ?? $configuration->logo }}" 
                    accept="image/png, image/jpg, image/jpeg"
                >
            </div>
            <div class="mb-3">
                <label for="imageCurrent" class="form-label">Logo atual</label><br>
                {!! logo('configuration') !!}
            </div>
        </div>
    
        <div class="border rounded bg-white p-4 mb-4">
            <div class="mb-3">
                <label for="faviconId" class="form-label">Alterar o favicon do website</label><br>
                <input 
                    type="file" 
                    name="favicon"
                    class="form-control"
                    id="faviconId"
                    value="{{ old('logo') ?? $configuration->favicon }}" 
                    accept="image/png, image/jpg, image/x-icon"
                >
            </div>
            <div class="mb-3">
                <label class="form-label" for="faviconCurrent">Favicon atual</label><br>
                <div class="container--favicon--img">
                    @if($configuration->favicon === 'default')
                        <img src="{{ asset('images/favicon.png') }}" alt="Favicon" id="faviconCurrent">
                    @else
                        <img src="{{ asset($configuration->favicon) }}" alt="Favicon" id="faviconCurrent">
                    @endif
                    <br>
                </div>
            </div>
        </div>
    
        <input type="hidden" name="configuration_id" value="{{ $configuration->id }}">
        <input type="hidden" name="logo_path_old" value="{{ $configuration->logo }}">
        <input type="hidden" name="favicon_path_old" value="{{ $configuration->favicon }}">
    
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('dashboard.home') }}" class="btn btn-secondary">Cancelar</a>   
        </div>
    </form>

@endsection

@section('styles')
    <style>
        .container--favicon--img {
            width: 630px; 
            height: 150px;
            position: relative;
            background-image: url("{{ asset('images/admin/favicon_background.png') }}");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container--favicon--img > img {
            width: 25px;
            height: 25px;
            position: absolute; 
            top: 33px;
            left: 35px;
        }

        @media screen and (min-width:0px) and (max-width: 500px) {
            .container--favicon--img {
                width: 100%; 
                height: 150px;
            }
            .container--favicon--img > img {
                width: 20px;
                height: 20px;
                position: absolute;
                top: 35px;
                left: 35px;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>   

        const imagemLogo = document.getElementById('logoImage');
        imagemLogo.addEventListener('change', function(event) {
            const fileImage = event.target.files[0];

            const reader = new FileReader();
            reader.addEventListener('load', (event) => {
                const imageCurrent = document.getElementById('imageCurrent');
                imageCurrent.src = event.target.result;
            });
            reader.readAsDataURL(fileImage);
        });

        const faviconLogo = document.getElementById('faviconId');
        faviconLogo.addEventListener('change', function(event) {
            const fileFavicon = event.target.files[0];

            const reader = new FileReader();
            reader.addEventListener('load', (event) => {
                const faviconCurrent = document.getElementById('faviconCurrent');
                faviconCurrent.src = event.target.result;
            });
            reader.readAsDataURL(fileFavicon);
        });

    </script>
@endsection
