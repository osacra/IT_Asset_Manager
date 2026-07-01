IT Asset Manager — Relatório de Desenvolvimento
1. Contexto e Planejamento

O projeto IT Asset Manager foi desenvolvido como uma aplicação web voltada para o gerenciamento de ativos de Tecnologia da Informação em ambientes corporativos.

O problema central abordado é a dependência de planilhas eletrônicas para controle de equipamentos, o que gera falhas como:

Falta de rastreabilidade dos ativos
Duplicidade de informações
Ausência de histórico de movimentações
Dificuldade de controle de empréstimos
Baixa confiabilidade dos dados

A proposta do sistema é centralizar e automatizar a gestão de ativos de TI, garantindo integridade, histórico completo e controle de acesso baseado em perfis.

O desenvolvimento foi realizado utilizando Laravel 13 com arquitetura MVC e boas práticas de engenharia de software.

2. Objetivo da Aplicação

O objetivo do IT Asset Manager é fornecer uma plataforma web para:

Cadastro e gerenciamento de ativos de TI
Organização por categorias
Controle de colaboradores
Registro de empréstimos e devoluções
Manutenção de histórico completo de movimentações
Controle de acesso baseado em perfis (RBAC)
3. Público-Alvo
Departamentos de TI
Empresas de médio e pequeno porte
Setores de suporte técnico
Áreas de patrimônio e controle de equipamentos
4. Escopo do Sistema (MVP)
Funcionalidades implementadas:
Autenticação de usuários
CRUD de Categorias
CRUD de Ativos
CRUD de Colaboradores
Controle de permissões (Administrador e Técnico)
Registro de empréstimos
Registro de devoluções
Histórico de movimentações (em implementação/expansão)
Fora do escopo inicial:
API REST
QR Code ou código de barras
Notificações automáticas
Relatórios em PDF
Integrações externas
Multiempresa
5. Tecnologias Utilizadas
Laravel 12 (PHP 8.3+)
MySQL (Laragon)
Blade Template Engine
Bootstrap 5
FontAwesome
Eloquent ORM
Laravel Policies (controle de acesso)
Form Requests (validação)
Observers (auditoria e histórico)
Laravel Boost (apoio ao desenvolvimento com IA)
6. Modelagem do Banco de Dados
Entidades principais:
User
Categoria
StatusAtivo
Ativo
Colaborador
Emprestimo
HistoricoMovimentacao
Relacionamentos:
Categoria 1:N Ativo
StatusAtivo 1:N Ativo
Ativo 1:N Emprestimo
Colaborador 1:N Emprestimo
User 1:N Emprestimo
Ativo 1:N HistoricoMovimentacao
User 1:N HistoricoMovimentacao
7. Regras de Negócio
Um ativo pertence a apenas uma categoria
Um ativo possui apenas um status ativo por vez
Não pode existir mais de um empréstimo ativo para o mesmo ativo
Ao criar um empréstimo, o status do ativo é automaticamente alterado para "Em uso"
Ao registrar devolução:
Data de devolução é preenchida
Status volta para "Disponível"
Movimentação é registrada no histórico
Histórico de movimentações é imutável (não pode ser editado ou excluído)
8. Arquitetura e Padrões Utilizados

O sistema segue o padrão MVC do Laravel com aplicação de boas práticas:

Controllers enxutos
Uso de Form Requests para validação
Policies para controle de acesso (RBAC)
Eloquent ORM com relacionamentos bem definidos
Uso de Route Model Binding
Observers para auditoria e histórico
Paginação obrigatória em listagens
Eager Loading para otimização de consultas
9. Ferramentas de IA Utilizadas (Laravel Boost)

Foi utilizado o Laravel Boost como ferramenta de apoio ao desenvolvimento (Vibe Coding), com foco em:

Padronização de CRUDs
Auxílio na estruturação de código
Definição de boas práticas arquiteturais
Criação de Skills para orientar geração de código consistente
Skills criadas:
Identidade Visual (UI/UX com Bootstrap)
Padrão de CRUD Laravel
Segurança e Policies (RBAC)
Logs e Auditoria com Observers
10. Desenvolvimento (Vibe Coding)

O desenvolvimento foi realizado de forma incremental com apoio de IA, seguindo etapas:

Criação do projeto Laravel
Configuração do banco de dados
Implementação da autenticação
Desenvolvimento dos CRUDs principais:
Categorias
Ativos
Colaboradores
Implementação de Policies para controle de acesso
Estruturação de regras de negócio
Implementação de histórico via Observers (em andamento)

Todo código gerado foi validado manualmente, ajustado e testado para garantir aderência às boas práticas do Laravel.

11. Dificuldades Encontradas

Durante o desenvolvimento foram encontrados desafios como:

Configuração inicial do Laravel Boost
Problemas de integração de Policies com Controllers
Erros de binding de controllers em rotas
Ajustes em layouts Blade e componentes reutilizáveis
Padronização de estrutura entre CRUDs
12. Conclusão

O projeto IT Asset Manager atingiu seu objetivo principal de estruturar um sistema funcional de gestão de ativos de TI, com base em boas práticas de desenvolvimento e arquitetura Laravel.

A utilização de IA (Laravel Boost) contribuiu para acelerar a padronização do código e reforçar a consistência arquitetural.

Como evolução futura, o sistema pode ser expandido com:

Relatórios analíticos
Notificações automáticas
API REST
Integração com QR Code
Dashboard avançado com métricas