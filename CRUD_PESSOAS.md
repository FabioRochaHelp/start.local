# CRUD de Pessoas - Sistema Escolar

## Funcionalidades Implementadas

### ✅ Model (Pessoa)
- **Localização**: `app/Models/Pessoa.php`
- **Características**:
  - Soft Deletes (exclusão lógica)
  - Mutators para CPF e telefone (remove formatação)
  - Accessors para CPF e telefone formatados
  - Constantes para tipos de pessoa
  - Scopes para filtros (ativos, por tipo)
  - Relacionamentos preparados (comentados)

### ✅ Controller (PessoaController)
- **Localização**: `app/Http/Controllers/PessoaController.php`
- **Métodos**:
  - `index()` - Listagem com filtros e paginação
  - `create()` - Formulário de criação
  - `store()` - Salvar nova pessoa
  - `show()` - Visualizar pessoa
  - `edit()` - Formulário de edição
  - `update()` - Atualizar pessoa
  - `destroy()` - Excluir pessoa (soft delete)
  - `restore()` - Restaurar pessoa excluída
  - `toggleStatus()` - Ativar/desativar pessoa

### ✅ Request Validation (PessoaRequest)
- **Localização**: `app/Http/Requests/PessoaRequest.php`
- **Validações**:
  - Tipo obrigatório (enum)
  - Nome completo obrigatório
  - CPF único e com 11 dígitos
  - Data de nascimento anterior a hoje
  - Email único e válido
  - Telefone com 10-11 dígitos
  - Endereço obrigatório
- **Preparação automática**: Remove formatação de CPF e telefone

### ✅ Views Blade
- **Layout**: `resources/views/layouts/app.blade.php`
- **Listagem**: `resources/views/pessoas/index.blade.php`
- **Criação**: `resources/views/pessoas/create.blade.php`
- **Edição**: `resources/views/pessoas/edit.blade.php`
- **Visualização**: `resources/views/pessoas/show.blade.php`

### ✅ Rotas
- **Localização**: `routes/web.php`
- **Rotas implementadas**:
  ```php
  GET    /pessoas              - Listar pessoas
  GET    /pessoas/create       - Formulário de criação
  POST   /pessoas              - Salvar pessoa
  GET    /pessoas/{id}         - Visualizar pessoa
  GET    /pessoas/{id}/edit    - Formulário de edição
  PUT    /pessoas/{id}         - Atualizar pessoa
  DELETE /pessoas/{id}         - Excluir pessoa
  PATCH  /pessoas/{id}/toggle-status - Ativar/desativar
  PATCH  /pessoas/{id}/restore - Restaurar pessoa
  ```

### ✅ Seeder
- **Localização**: `database/seeders/PessoaSeeder.php`
- **Dados**: 6 pessoas de exemplo (alunos, professores, funcionários, responsáveis)

## Recursos Implementados

### 🔍 Filtros e Busca
- Filtro por tipo de pessoa
- Filtro por status (ativo/inativo)
- Busca por nome, CPF ou email
- Paginação (15 registros por página)

### 🎨 Interface
- Bootstrap 5 responsivo
- Font Awesome para ícones
- Máscaras para CPF e telefone (jQuery Mask)
- Alertas de sucesso/erro
- Confirmação de exclusão

### ✅ Validações
- Validação server-side completa
- Mensagens de erro personalizadas
- Validação de unicidade (CPF e email)
- Formatação automática de dados

### 🔒 Segurança
- CSRF protection
- Validação de dados
- Soft deletes
- Sanitização de entrada

## Como Usar

### 1. Acessar o Sistema
```
http://seu-dominio/pessoas
```

### 2. Funcionalidades Disponíveis
- **Listar**: Visualizar todas as pessoas com filtros
- **Criar**: Cadastrar nova pessoa
- **Visualizar**: Ver detalhes completos
- **Editar**: Alterar dados existentes
- **Ativar/Desativar**: Mudar status sem excluir
- **Excluir**: Remoção lógica (soft delete)

### 3. Tipos de Pessoa
- **ALUNO**: Estudantes da instituição
- **PROFESSOR**: Docentes
- **FUNCIONARIO**: Funcionários administrativos
- **RESPONSAVEL**: Responsáveis pelos alunos

## Próximos Passos

1. **Criar models relacionados**:
   - Aluno (extends Pessoa)
   - Professor (extends Pessoa)
   - Funcionario (extends Pessoa)
   - Responsavel (extends Pessoa)

2. **Implementar relacionamentos**:
   - Descomentar relacionamentos no model Pessoa
   - Criar foreign keys específicas

3. **Adicionar funcionalidades**:
   - Export para Excel/PDF
   - Import em lote
   - Histórico de alterações
   - Fotos de perfil

## Estrutura de Arquivos Criados

```
app/
├── Http/
│   ├── Controllers/
│   │   └── PessoaController.php
│   └── Requests/
│       └── PessoaRequest.php
├── Models/
│   └── Pessoa.php
database/
└── seeders/
    └── PessoaSeeder.php
resources/
└── views/
    ├── layouts/
    │   └── app.blade.php
    └── pessoas/
        ├── index.blade.php
        ├── create.blade.php
        ├── edit.blade.php
        └── show.blade.php
routes/
└── web.php (atualizado)
```

## Comandos Úteis

```bash
# Executar seeder
php artisan db:seed --class=PessoaSeeder

# Limpar cache de rotas
php artisan route:clear

# Verificar rotas
php artisan route:list --name=pessoas
```