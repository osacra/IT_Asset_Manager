@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cadastro de Colaboradores</h1>
        @can('create', App\Models\Colaborador::class)
            <a href="{{ route('colaboradores.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-user-plus fa-sm text-white-50"></i> Novo Colaborador
            </a>
        @endcan
    </div>

    {{-- Alertas de Feedback da Sessão --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4 border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Departamento</th>
                            <th>Cargo</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($colaboradores as $colaborador)
                            <tr>
                                <td class="fw-bold text-dark">{{ $colaborador->nome }}</td>
                                <td>{{ $colaborador->email }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $colaborador->departamento }}</span></td>
                                <td>{{ $colaborador->cargo }}</td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        @can('update', $colaborador)
                                            <a href="{{ route('colaboradores.edit', $colaborador) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $colaborador)
                                            <form action="{{ route('colaboradores.destroy', $colaborador) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja realmente remover este colaborador do sistema?')" title="Excluir">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Nenhum colaborador cadastrado até o momento.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $colaboradores->links() }}
            </div>
        </div>
    </div>
</div>
@endsection