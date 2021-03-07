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

    <h2 class="title--secretaria">Perfis</h2>
    <div class="d-flex justify-content-between my-3">
        <div class="form-group col-8">
            <input type="text" id="search" class="form-control" placeholder="Pesquisar pelo id ou nome do perfil"/>
        </div>
        @can('create', App\Models\Role::class)
            <a class="btn btn-primary col-3" href="{{ route('dashboard.roles.create') }}">Cadastrar Perfil</a>
        @endcan
    </div>
    
    <div class="table-responsive border border-1 rounded bg-white p-3">
        <table class="table table-borderless table-hover align-middle">
            <thead>
                <tr class="border-bottom">
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr class="border-bottom">
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @can('create', App\Models\Role::class)
                                <a class="btn btn-secondary mx-2" href="{{ route('dashboard.roles.edit', $role->id) }}">Editar</a> 
                            @endcan

                            @can('edit', App\Models\Role::class)
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $role->id }}">Excluir</button>

                                <!-- MODAIS DE EXCLUSÃO DAS SECRETARIAS -->
                                <div class="modal fade" id="exampleModal-{{ $role->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('dashboard.roles.destroy', $role->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Excluir Secretaria</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Deseja realmente <strong>excluir</strong> o perfil {{ $role->name }} ?
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
