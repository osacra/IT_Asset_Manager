# Skill: Trilha de Auditoria Imutável e Desacoplamento via Observers

## Contexto e Objetivo
Garantir a rastreabilidade completa do ciclo de vida dos ativos sem poluir a camada de controle com regras de escrita de histórico.

## Diretrizes de Implementação
1. **Uso de Observers:** Alterações de estado e criações de registros críticos devem ser escutadas por classes `Observer` do Eloquent (ex: `AtivoObserver`).
2. **Imutabilidade do Histórico:** A tabela de `historico_movimentacoes` serve exclusivamente para auditoria. Não devem ser geradas rotas, controllers ou views que permitam a edição (`update`) ou exclusão (`delete`) de registros de log.
3. **Captura de Contexto:** Todo log gerado de forma automatizada deve capturar de forma transparente o ID do usuário autenticado via `Auth::id()`.