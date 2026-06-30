@extends('layouts.app-admin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Categorias</h3>

        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
            + Nova Categoria
        </a>
    </div>

    {{-- Mensagens de feedback --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nome }}</td>
                            <td>{{ $categoria->descricao }}</td>
                            <td>
                                <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-warning">
                                    Editar
                                </a>

                                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Nenhuma categoria cadastrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $categorias->links() }}
            </div>

        </div>
    </div>
</div>
@endsection