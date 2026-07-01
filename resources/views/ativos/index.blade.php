@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Inventário de Ativos</h1>
        @can('create', App\Models\Ativo::class)
            <a href="{{ route('ativos.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Novo Ativo
            </a>
        @endcan
    </div>

    {{-- Componente de Alertas --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4 border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>Patrimônio</th>
                            <th>Nome/Modelo</th>
                            <th>Categoria</th>
                            <th>Status</th>
                            <th>Localização</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ativos as $ativo)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $ativo->patrimonio }}</span></td>
                                <td>
                                    <div class="fw-bold">{{ $ativo->nome }}</div>
                                    <div class="small text-muted">{{ $ativo->marca }} {{ $ativo->modelo }}</div>
                                </td>
                                <td>{{ $ativo->categoria->nome }}</td>
                                <td>
                                    @php
                                        $statusColor = match($ativo->status->nome) {
                                            'Disponível' => 'success',
                                            'Em uso' => 'primary',
                                            'Em manutenção' => 'warning',
                                            'Baixado' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusColor }}">{{ $ativo->status->nome }}</span>
                                </td>
                                <td>{{ $ativo->localizacao }}</td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        
                                        @can('update', $ativo)
                                            <a href="{{ route('ativos.edit', $ativo) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $ativo)
                                            <form action="{{ route('ativos.destroy', $ativo) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja excluir este ativo?')" title="Excluir">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Nenhum ativo encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $ativos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection