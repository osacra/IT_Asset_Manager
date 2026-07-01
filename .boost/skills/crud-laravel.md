# Skill: Padronização de CRUDs e Regras Arquiteturais Laravel

## Contexto e Objetivo
Garantir que todos os módulos (Categorias, Ativos, Colaboradores, Empréstimos) sigam rigorosamente os padrões de arquitetura Restful e as convenções do Laravel.

## Diretrizes do Backend (Controllers e Requests)
1. **Isolamento de Validação:** Regras de validação nunca devem ficar no Controller. Devem ser isoladas em uma classe especializada `Form Request` (`php artisan make:request`).
2. **Route Model Binding:** Injetar o Model diretamente como parâmetro nos métodos do Controller (`edit`, `update`, `destroy`) em vez de realizar buscas manuais por ID (`Model::find($id)`).
3. **Paginação Obrigatória:** Listagens (`index`) devem trafegar dados paginados com o método `->paginate(10)` ou `->paginate(15)`. O uso de `->get()` em listagens é estritamente proibido para evitar sobrecarga de memória.

## Diretrizes de Banco de Dados e Segurança
- **Integridade Referencial:** Métodos de destruição (`destroy`) devem validar previamente se existem relacionamentos ativos (ex: impedir a exclusão de um colaborador que possui empréstimos).
- **Autorização (Policies):** Métodos de escrita e leitura devem ser controlados por Laravel Policies. O controlador deve invocar `$this->authorizeResource(Model::class, 'variavel');` no seu construtor.
- **Consultas Otimizadas:** Implementar Eager Loading (`with(['relacao'])`) nas listagens para mitigar o problema de performance de consultas N+1.