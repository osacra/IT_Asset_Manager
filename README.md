# IT Asset Manager — Sistema de Gestão de Ativos de TI

## Descrição da Aplicação

O **IT Asset Manager** é uma aplicação web desenvolvida em **Laravel 13 (PHP 8.3+)**, utilizando **MySQL**, **Laragon** e **Bootstrap 5**, com apoio do **Laravel Boost (Vibe Coding)**.

O sistema resolve problemas de controle manual de ativos de TI, como planilhas desatualizadas, falta de rastreabilidade e ausência de histórico de movimentações.

A aplicação permite gerenciar:

- Ativos de TI (notebooks, monitores, periféricos etc.)
- Categorias de ativos
- Colaboradores
- Empréstimos e devoluções
- Histórico de movimentações

---

## Usuários de Teste (Seeders)

Os usuários abaixo são criados automaticamente via `DatabaseSeeder`.

### Administrador

- **E-mail:** admin@empresa.com
- **Senha:** password
- **Perfil:** Administrador
- **Permissões:** acesso total ao sistema.

### Técnico

- **E-mail:** tecnico@empresa.com
- **Senha:** password
- **Perfil:** Técnico
- **Permissões:** operações de empréstimos e devoluções.

---

## Tecnologias Utilizadas

- Laravel 13
- PHP 8.3+
- Bootstrap 5
- Blade
- MySQL
- Laragon
- Font Awesome
- Laravel Boost

---

## Instalação

### Clonar o repositório

```bash
git clone <URL_DO_REPOSITORIO>
cd IT_Asset_Manager
```

### Instalar dependências

```bash
composer install
```

### Configurar ambiente

```bash
cp .env.example .env
php artisan key:generate
```

### Configurar o banco de dados

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=it_asset_manager
DB_USERNAME=root
DB_PASSWORD=
```

### Executar migrations e seeders

```bash
php artisan migrate --seed
```

### Instalar o Laravel Boost

```bash
php artisan boost:install
```

Durante a instalação selecione:

- guidelines
- skills
- mcp (opcional)

### Executar o projeto

```bash
php artisan serve
```

Acesse:

```
http://127.0.0.1:8000
```

---

## Estrutura do Projeto

```text
IT_Asset_Manager/
├── .boost/
│   └── skills/
├── app/
├── database/
├── resources/
├── routes/
├── tests/
├── README.md
├── RELATORIO.md
├── PLANO_IMPLEMENTACAO.md
└── .env
```

---

## Regras de Negócio

### Controle de Acesso

**Administrador**

- CRUD completo
- Gerenciamento de usuários
- Exclusão de registros

**Técnico**

- Consulta de cadastros
- Registro de empréstimos
- Registro de devoluções

### Ativos

- Um ativo pertence a uma categoria.
- Apenas um empréstimo ativo por ativo.
- O status é atualizado automaticamente.

### Empréstimos

Ao criar um empréstimo:

- Status → **Em uso**

Ao registrar uma devolução:

- Data de devolução preenchida.
- Status → **Disponível**.
- Histórico atualizado.

---

## Auditoria

As movimentações são registradas automaticamente utilizando **Eloquent Observers**.

---

## Documentação

- `README.md`
- `PLANO_IMPLEMENTACAO.md`
- `RELATORIO.md`
- `.boost/skills/`