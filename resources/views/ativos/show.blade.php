@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Coluna de Detalhes do Ativo --}}
        <div class="col-md-4">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Detalhes do Ativo</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Patrimônio:</span>
                            <strong>{{ $ativo->patrimonio }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Status:</span>
                            <span class="badge bg-info">{{ $ativo->statusAtivo->nome }}</span>
                        </li>
                        <li class="list-group-item">
                            <span class="text-muted d-block small">Nome:</span>
                            <strong>{{ $ativo->nome }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Marca/Modelo:</span>
                            <span>{{ $ativo->marca }} / {{ $ativo->modelo }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Aquisição:</span>
                            <span>{{ \Carbon\Carbon::parse($ativo->data_aquisicao)->format('d/m/Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Coluna de Histórico de Movimentações --}}
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Linha do Tempo de Movimentações</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Tipo</th>
                                    <th>Usuário</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ativo->historicos as $hist)
                                <tr>
                                    <td class="small">{{ $hist->created_at->format('d/m/Y H:i') }}</td>
                                    <td><span class="badge bg-secondary">{{ $hist->tipo }}</span></td>
                                    <td>{{ $hist->usuario->name }}</td>
                                    <td class="small">{{ $hist->descricao }}</td>
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