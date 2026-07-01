@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Controle de Empréstimos</h1>
        <a href="{{ route('emprestimos.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-handshake fa-sm text-white-50"></i> Novo Empréstimo
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4 border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Ativo / Patrimônio</th>
                            <th>Colaborador</th>
                            <th>Data Retirada</th>
                            <th>Data Devolução</th>
                            <th>Responsável (TI)</th>
                            <th class="text-end">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($emprestimos as $emprestimo)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $emprestimo->ativo->nome }}</div>
                                    <small class="badge bg-secondary">{{ $emprestimo->ativo->patrimonio }}</small>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $emprestimo->colaborador->nome }}</div>
                                    <small class="text-muted">{{ $emprestimo->colaborador->departamento }}</small>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($emprestimo->data_retirada)->format('d/m/Y') }}</td>
                                <td>
                                    @if($emprestimo->data_retorno)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i> {{ \Carbon\Carbon::parse($emprestimo->data_retorno)->format('d/m/Y') }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i> Em aberto
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $emprestimo->usuario->name }}</td>
                                <td class="text-end">
                                    @if(!$emprestimo->data_retorno)
                                        <form action="{{ route('emprestimos.devolver', $emprestimo) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('Confirmar a devolução deste ativo ao estoque?')">
                                                <i class="fas fa-undo-alt me-1"></i> Devolver
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-light disabled" title="Movimentação concluída">
                                            <i class="fas fa-lock"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Nenhuma movimentação registrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $emprestimos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection