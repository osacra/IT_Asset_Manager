IT Asset Manager — Sistema de Gestão de Ativos de TI
Descrição da Aplicação

O IT Asset Manager é uma aplicação web desenvolvida em Laravel 12 (PHP 8.3+), utilizando MySQL, Laragon e Bootstrap 5, com apoio do Laravel Boost (Vibe Coding).

O sistema resolve problemas de controle manual de ativos de TI, como planilhas desatualizadas, falta de rastreabilidade e ausência de histórico de movimentações.

A aplicação permite gerenciar:

Ativos de TI (notebooks, monitores, periféricos, etc.)
Categorias de ativos
Colaboradores
Empréstimos e devoluções
Histórico completo de movimentações
Usuários de Teste (Seeders)

Os usuários abaixo são criados automaticamente via DatabaseSeeder:

Perfil: Administrador
E-mail: admin@empresa.com
Senha: password
Permissões: acesso total ao sistema (CRUDs, usuários, histórico e configurações)

Perfil: Técnico
E-mail: tecnico@empresa.com
Senha: password
Permissões: acesso operacional (visualização, empréstimos e devoluções)

Tecnologias Utilizadas
Backend: Laravel 12 (PHP 8.3+)
Frontend: Blade + Bootstrap 5 + FontAwesome
Banco de Dados: MySQL (Laragon)
Ambiente Local: Laragon + Apache
ORM: Eloquent ORM
Segurança: Policies + Form Requests (RBAC)
Arquitetura: MVC com Services quando necessário
IA Assistida: Laravel Boost (Vibe Coding)
Auditoria: Eloquent Observers
Instalação e Execução
1. Clonar o repositório
git clone <url-do-repositorio>
cd IT_Asset_Manager
2. Instalar dependências
composer install
3. Configurar ambiente
cp .env.example .env
php artisan key:generate
4. Configurar banco de dados (.env)

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=it_asset_manager
DB_USERNAME=root
DB_PASSWORD=

5. Executar migrations e seeders
php artisan migrate --seed
6. Instalar Laravel Boost (opcional após estrutura pronta)
php artisan boost:install

Observação: durante a instalação, selecione manualmente:

guidelines
skills
mcp (opcional)
7. Iniciar servidor
php artisan serve

Acesso:
http://127.0.0.1:8000

Estrutura do Projeto

IT_Asset_Manager/
├── .boost/
│ └── skills/
├── app/
│ ├── Http/
│ ├── Models/
│ ├── Policies/
│ └── Observers/
├── database/
│ ├── migrations/
│ └── seeders/
├── resources/
│ ├── views/
│ └── layouts/
├── routes/
├── tests/
├── README.md
├── RELATORIO.md
├── PLANO_IMPLEMENTACAO.md
└── .env

Regras de Negócio
Controle de Acesso (RBAC)

Administrador:

CRUD completo
Gerenciamento de usuários
Pode excluir registros

Técnico:

Apenas leitura de cadastros
Pode registrar empréstimos e devoluções
Não pode excluir ou editar dados críticos
Regras de Ativos
Um ativo pertence a uma única categoria
Um ativo possui apenas um status ativo por vez
Não pode existir mais de um empréstimo ativo para o mesmo ativo
Empréstimos e Devoluções

Ao criar um empréstimo:

Status do ativo muda automaticamente para "Em uso"

Ao registrar devolução:

Data de devolução é preenchida
Status muda para "Disponível"
Registro é salvo no histórico
Auditoria
Todas as movimentações importantes são registradas no histórico
Histórico é imutável (não pode ser editado ou deletado)
Implementado via Observers do Eloquent
Documentos do Projeto
README.md: instruções de execução
PLANO_IMPLEMENTACAO.md: planejamento do sistema
RELATORIO.md: relatório acadêmico
.boost/skills/: regras do Laravel Boost