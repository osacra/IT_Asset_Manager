# Skill: Identidade Visual e UX para Painel Administrativo

## Contexto e Objetivo
Esta Skill orienta a geração de interfaces Blade para o sistema IT Asset Manager. Todas as telas devem herdar a estrutura mestre e manter consistência visual absoluta, focando na usabilidade para o técnico de TI.

## Diretrizes de Layout e Estrutura
1. **Herança Obligatória:** Todas as views de CRUD devem iniciar com `@extends('layouts.app-admin')`.
2. **Seção de Conteúdo:** Todo o HTML deve estar contido dentro de `@section('content')` e envolto por uma div `.container-fluid`.
3. **Componentização de Títulos:** O topo da página deve conter um título `h1.h3.text-gray-800` alinhado dinamicamente com botões de ação primária (ex: "Novo Registro").

## Paleta de Cores e Componentes (Bootstrap 5)
- **Ações Primárias/Sucesso:** Botões de criação devem usar `.btn-primary` ou `.btn-success` acompanhados de ícones FontAwesome (ex: `<i class="fas fa-plus"></i>`).
- **Tabelas de Dados:** Listagens devem utilizar as classes `.table .table-hover .align-middle` com um cabeçalho `.table-light`.
- **Cartões (Cards):** Blocos de conteúdo ou formulários devem ser encapsulados em `.card .shadow .border-0` para um visual moderno e limpo.

## UX e Tratamento de Erros
- **Feedback de Sessão:** Sempre incluir os blocos de verificação para `session('success')` e `session('error')` no topo do container.
- **Validação de Formulários:** Inputs obrigatórios devem usar a diretiva `@error('campo') is-invalid @enderror` e renderizar a mensagem de erro logo abaixo com a classe `.invalid-feedback`.
- **Modais e Confirmações:** Botões de exclusão (`DELETE`) devem obrigatoriamente possuir um gatilho `onclick="return confirm('...')"` para evitar cliques acidentais.