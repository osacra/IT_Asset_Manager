# Plano de Implementação — IT Asset Manager

## 1. Contexto
- **Objetivo da Aplicação:** Gerenciar de forma centralizada o inventário de ativos de TI (hardware, notebooks, monitores, etc.) e o controle de empréstimos desses equipamentos para os colaboradores da empresa.
- **Problema que Resolve:** Elimina o uso de planilhas descentralizadas e suscetíveis a erros, mitigando a perda de periféricos, falta de histórico de manutenção e falta de rastreabilidade sobre com quem está cada equipamento.
- **Público-Alvo:** Equipes de suporte de TI, técnicos de infraestrutura e administradores de redes/sistemas.

## 2. Escopo e Funcionalidades
- **Autenticação e Perfis (RBAC):** Login seguro com diferenciação de privilégios entre `administrador` (acesso total) e `tecnico` (leitura e controle operacional de empréstimos).
- **Gestão de Categorias:** CRUD para classificação de equipamentos (ex: Notebooks, Monitores, Acessórios).
- **Gestão de Ativos:** CRUD completo de inventário com número de patrimônio, número de série, marca, modelo, valor de compra e status.
- **Gestão de Colaboradores:** Cadastro dos funcionários que recebem os equipamentos da empresa.
- **Controle de Empréstimos e Devoluções:** Vínculo transacional entre ativos e colaboradores com atualização automática de status do hardware ("Disponível" <-> "Em uso").
- **Trilha de Auditoria (Logs):** Registro automatizado e imutável de todas as ações importantes do ciclo de vida de um ativo através de Observers.

## 3. Entidades do Banco de Dados
- **User:** Usuários do sistema (Técnicos e Administradores).
- **Categoria:** Grupos de classificação dos ativos.
- **StatusAtivo:** Estados físicos do item (Disponível, Em uso, Manutenção, Baixado).
- **Ativo:** Os equipamentos cadastrados no inventário.
- **Colaborador:** Funcionários da empresa elegíveis para receber ativos.
- **Emprestimo:** Registro histórico e ativo de movimentações de saída e retorno.
- **HistoricoMovimentacao:** Logs detalhados para auditoria global do sistema.

## 4. Telas da Aplicação
- **Dashboard:** Painel com indicadores gráficos e métricas de ativos totais, disponíveis e emprestados.
- **Módulo Categorias:** Listagem, cadastro e edição.
- **Módulo Ativos:** Listagem com badges de status, ficha detalhada (360º) com timeline, cadastro e edição.
- **Módulo Colaboradores:** Listagem, cadastro e edição de funcionários.
- **Módulo Empréstimos:** Central de saídas de equipamentos e botões de ação imediata para devolução.
- **Histórico Geral:** Painel de auditoria estático de leitura contínua de logs de atividade.

## 5. Ordem de Implementação Técnica
1. **Configuração Inicial:** Setup do projeto Laravel, instalação e ativação do `laravel/boost`.
2. **Modelagem e Migrations:** Criação das tabelas e relacionamentos com chaves estrangeiras no MySQL.
3. **Seeders e Fábricas:** Geração de dados de teste e cadastro dos usuários padrão (`administrador` e `tecnico`).
4. **Infraestrutura e Segurança:** Implementação das Form Requests para validação e Policies para proteção de rotas por Role.
5. **Autopopulação de Logs:** Criação do `AtivoObserver` para automatizar a trilha de auditoria de forma isolada.
6. **Desenvolvimento dos Controllers e Módulos (CRUDs):** Categorias, Ativos e Colaboradores.
7. **Desenvolvimento do Core Operacional:** Métodos transacionais de Empréstimo e Devolução.
8. **Camada Visual (Blade + Bootstrap 5):** Construção das interfaces com base no layout mestre `layouts.app-admin`.
9. **Polimento e Revisão:** Eliminação de consultas N+1 via Eager Loading e escrita dos relatórios exigidos.

## 6. Riscos e Critérios de Aceite
- **Risco Técnico:** Concorrência em requisições de empréstimo (dois técnicos tentarem emprestar o mesmo ativo simultaneamente). *Mitigação:* Uso de travas e validação direta de status no controller protegida por `DB::transaction`.
- **Critério de Aceite 1:** Um usuário com perfil `tecnico` não pode visualizar os botões de edição/exclusão de ativos nem acessar as rotas de escrita diretamente pela URL.
- **Critério de Aceite 2:** Um colaborador que possua um empréstimo ativo registrado no histórico jamais poderá ser excluído do banco de dados, garantindo a consistência referencial.