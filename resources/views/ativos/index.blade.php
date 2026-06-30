@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Gerenciamento de Ativos</h1>
        @can('create', App\Models\Ativo::class)
            <a href="{{ route('ativos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Novo Ativo
            </a>
        @endcan
    </div>

    @include('components.alerts') {{-- Componente de alertas de sucesso/erro --}}

    <div class="card shadow border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
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
                                <strong>{{ $ativo->nome }}</strong><br>
                                <small class="text-muted">{{ $ativo->marca }} {{ $ativo->modelo }}</small>
                            </td>
                            <td>{{ $ativo->categoria->nome }}</td>
                            <td>
                                @php
                                    $badgeClass = match($ativo->statusAtivo->nome) {
                                        'Disponível' => 'success',
                                        'Em uso' => 'primary',
                                        'Em manutenção' => 'warning',
                                        'Baixado' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $badgeClass }}">{{ $ativo->statusAtivo->nome }}</span>
                            </td>
                            <td>{{ $ativo->localizacao }}</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('ativos.show', $ativo) }}" class="btn btn-sm btn-outline-info" title="Ver Detalhes">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @can('update', $ativo)
                                        <a href="{{ route('ativos.edit', $ativo) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('delete', $ativo)
                                        <form action="{{ route('ativos.destroy', $ativo) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja realmente excluir este ativo?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Nenhum ativo cadastrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $ativos->links() }}
        </div>
    </div>
</div>
@endsection