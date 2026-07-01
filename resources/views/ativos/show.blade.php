@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ficha do Ativo: {{ $ativo->patrimonio }}</h1>
        <a href="{{ route('ativos.index') }}" class="btn btn-secondary btn-sm">Voltar</a>
    </div>

    <div class="row">
        {{-- Coluna 1: Informações Técnicas --}}
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4 border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h6 class="m-0 font-weight-bold">Detalhes Técnicos</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Status Atual:</span>
                            <span class="badge bg-info text-dark">{{ $ativo->status->nome }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Categoria:</span>
                            <span class="fw-bold">{{ $ativo->categoria->nome }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Marca/Modelo:</span>
                            <span>{{ $ativo->marca }} / {{ $ativo->modelo }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Valor:</span>
                            <span>R$ {{ number_format($ativo->valor, 2, ',', '.') }}</span>
                        </li>
                    </ul>
                    <div class="mt-3">
                        <small class="text-muted fw-bold">Observações:</small>
                        <p class="small text-dark mt-1">{{ $ativo->observacoes ?? 'Sem observações registradas.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Coluna 2: Histórico de Movimentações --}}
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4 border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Linha do Tempo / Auditoria</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Data</th>
                                    <th>Tipo</th>
                                    <th>Usuário</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ativo->historicos as $historico)
                                    <tr>
                                        <td class="small">{{ $historico->created_at->format('d/m/Y H:i') }}</td>
                                        <td><span class="badge bg-secondary">{{ $historico->tipo }}</span></td>
                                        <td>{{ $historico->usuario->name }}</td>
                                        <td class="small">{{ $historico->descricao }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection