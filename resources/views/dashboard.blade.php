@extends('layouts.app-admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm border-start border-primary border-4 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted fw-normal mb-1">Total de Ativos</h6>
                    <h3 class="mb-0 fw-bold">{{ $totalAtivos }}</h3>
                </div>
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded">
                    <i class="bi bi-box-seam fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm border-start border-success border-4 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted fw-normal mb-1">Ativos Disponíveis</h6>
                    <h3 class="mb-0 fw-bold">{{ $ativosDisponiveis }}</h3>
                </div>
                <div class="bg-success bg-opacity-10 text-success p-3 rounded">
                    <i class="bi bi-check-circle fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm border-start border-warning border-4 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted fw-normal mb-1">Emprestados</h6>
                    <h3 class="mb-0 fw-bold">{{ $ativosEmprestados }}</h3>
                </div>
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded">
                    <i class="bi bi-person-check fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm border-start border-danger border-4 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted fw-normal mb-1">Em Manutenção</h6>
                    <h3 class="mb-0 fw-bold">{{ $ativosManutencao }}</h3>
                </div>
                <div class="bg-danger bg-opacity-10 text-danger p-3 rounded">
                    <i class="bi bi-wrench-adjustable fs-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-xl-6">
        <div class="card border-0 shadow-sm h-100 p-4">
            <h5 class="card-title fw-bold mb-3"><i class="bi bi-arrow-left-right text-muted me-2"></i> Últimos Empréstimos</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Ativo</th>
                            <th>Colaborador</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimosEmprestimos as $emprestimo)
                            <tr>
                                <td><strong>[{{ $emprestimo->ativo->patrimonio }}]</strong> {{ $emprestimo->ativo->nome }}</td>
                                <td>{{ $emprestimo->colaborador->nome }}</td>
                                <td>{{ $emprestimo->data_emprestimo->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">Nenhum empréstimo registrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-6">
        <div class="card border-0 shadow-sm h-100 p-4">
            <h5 class="card-title fw-bold mb-3"><i class="bi bi-clock-history text-muted me-2"></i> Últimas Movimentações</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tipo</th>
                            <th>Descrição</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasMovimentacoes as $movimentacao)
                            <tr>
                                <td>
                                    <span class="badge 
                                        {{ $movimentacao->tipo === 'Cadastro' ? 'bg-success' : '' }}
                                        {{ $movimentacao->tipo === 'Empréstimo' ? 'bg-primary' : '' }}
                                        {{ $movimentacao->tipo === 'Devolução' ? 'bg-info text-dark' : '' }}
                                        {{ $movimentacao->tipo === 'Alteração' ? 'bg-secondary' : '' }}
                                        {{ $movimentacao->tipo === 'Manutenção' ? 'bg-warning text-dark' : '' }}
                                        {{ $movimentacao->tipo === 'Baixa' ? 'bg-danger' : '' }}
                                    ">
                                        {{ $movimentacao->tipo }}
                                    </span>
                                </td>
                                <td class="text-truncate" style="max-width: 250px;">{{ $movimentacao->descricao }}</td>
                                <td>{{ $movimentacao->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">Nenhum histórico registrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection