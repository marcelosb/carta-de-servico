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

    <h2 class="title--secretaria">Secretarias</h2>
    <div class="d-flex justify-content-between my-3">
        <div class="form-group col-8">
            <input type="text" id="search" class="form-control" placeholder="Pesquisar pelo nome ou tema da secretaria"/>
        </div>
        @can('create', App\Models\Secretary::class)
            <a class="btn btn-primary col-3" href="{{ route('dashboard.secretaries.create') }}">Cadastrar Secretaria</a>
        @endcan
    </div>
    
    <div class="table-responsive border border-1 rounded bg-white p-3">
        <table class="table table-borderless table-hover align-middle">
            <thead>
                <tr class="border-bottom">
                    <th>Nome</th>
                    <th>Tema/Apelido</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($secretaries as $secretary)
                    <tr class="border-bottom">
                        <td>{{ $secretary->name }}</td>
                        <td>{{ $secretary->theme }}</td>
                        <td>
                            @can('edit', App\Models\Secretary::class)
                                <a class="btn btn-secondary mx-2" href="{{ route('dashboard.secretaries.edit', ['secretary' => $secretary->id]) }}">Editar</a> 
                            @endcan

                            @can('delete', App\Models\Secretary::class)
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $secretary->id }}">Excluir</button>

                                <!-- MODAIS DE EXCLUSÃO DAS SECRETARIAS -->
                                <div class="modal fade" id="exampleModal-{{ $secretary->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('dashboard.secretaries.destroy', ['secretary' => $secretary->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Excluir Secretaria</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Deseja realmente <strong>excluir</strong> o órgão {{ $secretary->name }} ?
                                                    <input type="hidden" name="codigo_secretaria" value="{{ $secretary->id }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn text-danger border-danger" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('styles')
    <style>
        @media screen and (min-width:700px) and (max-width:1000px) {
            .title--secretaria + div > div {
                width: 60%;
            }
            .title--secretaria + div > a {
                width: 30%;
            }
        }
        @media screen and (min-width:0px) and (max-width:699px) {
            .title--secretaria + div {
                display: flex;
                flex-direction: column-reverse;
            }
            .title--secretaria + div > div {
                width: 100%;
            }
            .title--secretaria + div > a {
                width: 100%;
                margin-bottom: 10px;
            }
            table > tbody > tr > td > a.btn {
                margin: 0px !important;
            }
        }

        @media screen and (min-width:0px) and (max-width:699px) {
            .title--secretaria + div {
                display: flex;
                flex-direction: column-reverse;
            }
            .title--secretaria + div > div {
                width: 100%;
            }
            .title--secretaria + div > a {
                width: 100%;
                margin-bottom: 10px;
            }
            table > tbody > tr > td > a.btn {
                margin: 0px !important;
            }
        }
    </style> 
@endsection

@section('scripts')
    <script>
        (async () => {
            const { Search } = await import("{{ asset('js/Search.js') }}");
            Search.run();
        })();
    </script>
@endsection
