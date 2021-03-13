@extends('admin.dashboard.layouts.master')

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

    <h2 class="title--servico">Serviços</h2>
    <div class="d-flex justify-content-between my-3">
        <div class="form-group col-8">
            <input type="text" id="search" class="form-control" placeholder="Pesquisar pelo nome ou tema do serviço"/>
        </div>
        @can('create', App\Models\Service::class)
            <a class="btn btn-primary col-3" href="{{ route('dashboard.services.create') }}">Cadastrar Serviço</a>
        @endcan
    </div>

    <div class="table-responsive border border-1 rounded bg-white p-3">
        <table class="table table-borderless table-hover align-middle">
            <thead>
                <tr class="border-bottom">
                    <th>Nome</th>
                    <th>Tema</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr class="border-bottom">
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->secretary->theme }}</td>
                        <td>
                            @can('edit', App\Models\Service::class)
                                <a class="btn btn-secondary mx-2" href="{{ route('dashboard.services.edit', ['service' => $service->id]) }}">Editar</a> 
                            @endcan

                            @can('delete', App\Models\Service::class)
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $service->id }}">Excluir</button>
                            
                                <!-- MODAIS DE EXCLUSÃO DAS SECRETARIAS -->
                                <div class="modal fade" id="exampleModal-{{ $service->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('dashboard.services.destroy', ['service' => $service->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Excluir Serviço</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Deseja realmente <strong>excluir</strong> o serviço {{ $service->name}} ?
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
                @empty
                    <tr>
                        <td colspan="3" class="fs-3 text-secondary text-center" style="background-color:rgba(0, 0, 0, 0.075);">
                            Não existem serviços cadastradas no sistema
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINAÇÃO --}}
        {{ $services->links() }}

    </div>

@endsection

@section('styles')
    <style>
        .container--pagination {
            margin-top: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container--pagination > .container--pagination--item {
            padding: 4px 12px;
            background: #FFFFFF;
            color: #0D6EFD;
            text-decoration: none;
            border-left: 1px solid #CCC;
            border-top: 1px solid #CCC;
            border-bottom: 1px solid #CCC;
        }
        .container--pagination--item:last-child {
            border-right: 1px solid #CCC;
        }
        .container--pagination--item:hover {
            background-color: #DFE6E6 !important;
        }
        .container--pagination--active,
        .container--pagination--active:hover {
            background-color: #0D6EFD !important;
            color: #FFFFFF !important;
            cursor: default;
        }

        @media screen and (min-width:700px) and (max-width:1000px) {
            .title--servico + div > div {
                width: 60%;
            }
            .title--servico + div > a {
                width: 30%;
            }
        }
        @media screen and (min-width:0px) and (max-width:699px) {
            .title--servico + div {
                display: flex;
                flex-direction: column-reverse;
            }
            .title--servico + div > div {
                width: 100%;
            }
            .title--servico + div > a {
                width: 100%;
                margin-bottom: 10px;
            }
            table > tbody > tr > td > a.btn {
                margin: 0px !important;
            }
        }

        @media screen and (min-width:0px) and (max-width:699px) {
            .title--servico + div {
                display: flex;
                flex-direction: column-reverse;
            }
            .title--servico + div > div {
                width: 100%;
            }
            .title--servico + div > a {
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
            const { Search } = await import("{{ asset('js/admin/dashboard/Search.js') }}");
            Search.run();
        })();
    </script>
@endsection
