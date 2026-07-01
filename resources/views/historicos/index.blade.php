@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Histórico de Movimentações</h1>
        <p class="text-muted small">Trilha de auditoria imutável de todas as ações importantes realizadas no inventário.</p>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list me-1"></i> Logs de Atividades</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Data/Hora</th>
                            <th>Ativo / Patrimônio</th>
                            <th>Tipo de Ação</th>
                            <th>Executor (Usuário)</th>
                            <th>Descrição do Evento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($historicos as $historico)
                            <tr>
                                <td class="small text-muted">
                                    {{ $historico->created_at->format('d/m/Y H:i:s') }}
                                </td>
                                <td>
                                    @if($historico->ativo)
                                        <div class="fw-bold text-dark">{{ $historico->ativo->nome }}</div>
                                        <small class="badge bg-secondary">{{ $historico->ativo->patrimonio }}</small>
                                    @else
                                        <span class="text-danger small"><i class="fas fa-exclamation-triangle"></i> Ativo Removido</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $badgeColor = match($historico->tipo) {
                                            'Cadastro' => 'success',
                                            'Alteração' => 'info',
                                            'Empréstimo' => 'primary',
                                            'Devolução' => 'warning text-dark',
                                            'Manutenção' => 'dark',
                                            'Baixa' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badgeColor }}">{{ $historico->tipo }}</span>
                                </td>
                                <td>
                                    <div class="small fw-bold">{{ $historico->usuario->name }}</div>
                                    <div class="text-muted opacity-75" style="font-size: 0.75rem;">{{ $historico->usuario->role }}</div>
                                </td>
                                <td class="small text-secondary" style="max-width: 300px;">
                                    {{ $historico->descricao }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Nenhum registro de auditoria encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $historicos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection