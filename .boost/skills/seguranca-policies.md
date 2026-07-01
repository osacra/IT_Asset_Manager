# Skill: Controle de Acesso Baseado em Perfis (RBAC via Policies)

## Contexto e Objetivo
Orientar a IA na implementação do controle de acesso do sistema, dividindo os privilégios entre os perfis de `administrador` e `tecnico`.

## Regras de Autorização (Policies)
1. **Perfil Administrador:** Possui bypass total ou retorno `true` em todas as ações de mutação de dados (`create`, `update`, `delete`).
2. **Perfil Técnico:** Permissão estrita de leitura (`viewAny`, `view`) e ações operacionais cotidianas (como registrar empréstimos e devoluções). Bloqueado de criar, editar ou remover cadastros base (Ativos, Categorias, Colaboradores).

## Integração com o Blade
- Elementos visuais restritos ao administrador devem ser encapsulados pelas diretivas `@can('create', App\Models\Classe::class)` ou `@can('update', $objeto)`.