@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categorias de Ativos</h1>
        @can('create', App\Models\Categoria::class)
            <a href="{{ route('categorias.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Nova Categoria
            </a>
        @endcan
    </div>

    {{-- Alertas de Feedback da Sessão (Sucesso ou Erro de Integridade) --}}
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
                            <th>Nome da Categoria</th>
                            <th>Descrição</th>
                            <th>Qtd. de Ativos</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $categoria)
                            <tr>
                                <td class="fw-bold text-dark">{{ $categoria->nome }}</td>
                                <td class="text-secondary small">{{ $categoria->descricao ?? 'Nenhuma descrição fornecida.' }}</td>
                                <td>
                                    {{-- Exibe a contagem de ativos vinculados se o relacionamento existir --}}
                                    <span class="badge bg-light text-dark border">
                                        {{ $categoria->ativos_count ?? $categoria->ativos()->count() }} equipamentos
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        @can('update', $categoria)
                                            <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $categoria)
                                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja realmente remover esta categoria? Essa ação não poderá ser desfeita.')" title="Excluir">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Nenhuma categoria cadastrada até o momento.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $categorias->links() }}
            </div>
        </div>
    </div>
</div>
@endsection