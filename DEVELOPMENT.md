# CheckReport5 - Comandos Úteis

Referência rápida de comandos para desenvolvimento, deploy e manutenção do CheckReport5.

## 🚀 Desenvolvimento Local

### Setup Inicial
```bash
# Clone e configure o projeto
git clone https://github.com/seu-usuario/checkreport.git
cd checkreport

# Executar script de setup automático
bash setup.sh
```

### Executar a Aplicação
```bash
# Terminal 1: Servidor Laravel
php artisan serve

# Terminal 2: Vite dev server
npm run dev

# Acesse: http://localhost:8000
```

### Build para Produção
```bash
npm run build    # Compilar assets para produção
npm run lint     # Verificar linting
```

---

## 🗄️ Banco de Dados

### Migrations
```bash
# Executar todas as migrations
php artisan migrate

# Executar migrations com seeds (dados iniciais)
php artisan migrate:seed

# Rollback última migration
php artisan migrate:rollback

# Rollback todas as migrations
php artisan migrate:reset

# Refresh (rollback + migrate)
php artisan migrate:refresh

# Refresh com seeds
php artisan migrate:refresh --seed

# Ver status das migrations
php artisan migrate:status

# Criar nova migration
php artisan make:migration create_tabela_name
```

### Seeds (Dados Iniciais)
```bash
# Executar todos os seeders
php artisan db:seed

# Executar seeder específico
php artisan db:seed --class=AdminSeeder

# Criar novo seeder
php artisan make:seeder NomeSeeder
```

### Tinker (Console PHP Interativo)
```bash
php artisan tinker

# Exemplos no tinker:
# Criar usuário: User::create(['name' => 'Test', 'email' => 'test@test.com', 'password' => bcrypt('password')])
# Listar usuários: User::all()
# Deletar usuário: User::find(1)->delete()
# Alterar senha admin: User::where('email', 'admin@checkreport.com')->update(['password' => bcrypt('nova-senha')])
```

---

## 🔧 Manutenção

### Limpeza e Cache
```bash
# Limpar todos os caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Otimizar autoload
composer dump-autoload -o

# Limpar cache de otimização
php artisan clear-compiled
```

### Armazenamento
```bash
# Criar link de storage (se não existir)
php artisan storage:link

# Limpar uploads antigos
php artisan storage:cleanup

# Ver espaço em disco
df -h storage/
```

---

## 🧪 Testes

### Executar Testes
```bash
# Todos os testes
php artisan test

# Apenas Feature tests
php artisan test tests/Feature

# Apenas Unit tests
php artisan test tests/Unit

# Teste específico
php artisan test tests/Feature/AuthenticationTest

# Com coverage
php artisan test --coverage

# Stop on first failure
php artisan test --stop-on-failure
```

### Criar Testes
```bash
# Criar teste de Feature
php artisan make:test FeatureTestName

# Criar teste de Unit
php artisan make:test UnitTestName --unit

# Criar Factory (modelo de teste)
php artisan make:factory UserFactory

# Criar Seeder
php artisan make:seeder AdminSeeder
```

---

## 👤 Gerenciar Usuários

### Via Tinker
```bash
php artisan tinker

# Listar todos os usuários
User::all()

# Encontrar usuário
User::find(1)
User::where('email', 'admin@checkreport.com')->first()

# Criar usuário
User::create([
    'name' => 'João Silva',
    'email' => 'joao@example.com',
    'password' => bcrypt('senha123'),
    'role' => \App\Enums\UserRole::User
])

# Alterar papel do usuário
$user = User::find(1);
$user->update(['role' => \App\Enums\UserRole::Admin]);

# Alternar entre ativo/inativo
$user->update(['is_active' => !$user->is_active]);

# Deletar usuário
User::find(1)->delete()
```

---

## 📦 Gerenciar Dependências

### Composer (PHP)
```bash
# Instalar todas as dependências
composer install

# Atualizar dependências
composer update

# Instalar nova dependência
composer require vendor/package

# Instalar dependência de dev
composer require --dev vendor/package

# Remover dependência
composer remove vendor/package

# Auditar vulnerabilidades
composer audit

# Ver dependências instaladas
composer show
```

### NPM (JavaScript)
```bash
# Instalar todas as dependências
npm install

# Atualizar dependências
npm update

# Instalar nova dependência
npm install package-name

# Instalar dependência de dev
npm install --save-dev package-name

# Remover dependência
npm uninstall package-name

# Ver vulnerabilidades
npm audit

# Limpar cache
npm cache clean --force
```

---

## 🔍 Debugging e Logs

### Logs
```bash
# Ver últimas linhas do log
tail -100 storage/logs/laravel.log

# Monitorar log em tempo real
tail -f storage/logs/laravel.log

# Ver log com filtro
grep "error" storage/logs/laravel.log

# Ver tamanho do log
du -h storage/logs/
```

### Debugging no Código
```php
// Dump and die (similar ao var_dump)
dd($variable);

// Dump simples
dump($variable);

// Log no arquivo
Log::info('Mensagem informativa');
Log::warning('Aviso');
Log::error('Erro');

// Debugbar (se instalado)
// Veja informações na barra de debug na página
```

### Modo Debug
```bash
# Ativar modo debug no .env
APP_DEBUG=true

# Desativar em produção
APP_DEBUG=false
```

---

## 🌐 Frontend/Assets

### Vite Commands
```bash
# Dev server (hot reload)
npm run dev

# Build para produção
npm run build

# Preview do build
npm run preview

# Linting
npm run lint
```

### Tailwind CSS
```bash
# Rebuildar CSS
npm run build

# Modo watch (recompila ao salvar)
npm run dev
```

---

## 📊 Deploy e Produção

### Preparar para Deploy
```bash
# Instalar sem dev dependencies
composer install --no-dev --optimize-autoloader

# Build production assets
npm run build

# Clear production cache
php artisan cache:clear
php artisan config:clear
```

### Hostinger/VPS
```bash
# SSH na VPS
ssh usuario@seu.vps.ip

# Atualizar código
cd /var/www/checkreport
git pull origin main

# Reinstalar dependências
composer install --no-dev --optimize-autoloader
npm install && npm run build

# Executar migrations
php artisan migrate --force

# Limpar cache
php artisan cache:clear
```

---

## 🔒 Segurança

### Gerar Chaves
```bash
# Gerar APP_KEY
php artisan key:generate

# Gerar nova chave
php artisan key:generate --force
```

### Permissões de Arquivo
```bash
# Dar permissão ao www-data
sudo chown -R www-data:www-data /var/www/checkreport

# Storage e bootstrap com escrita
sudo chmod -R 775 storage bootstrap/cache

# Arquivos com permissão reduzida
sudo chmod -R 644 public
sudo chmod 755 public
```

### Senhas e Segredos
```bash
# NÃO commitar .env com dados sensíveis
echo ".env" >> .gitignore

# Usar variáveis de ambiente em produção
# Definir via CloudPanel ou AWS Secrets Manager
```

---

## 📝 Git

### Commits e Pushes
```bash
# Ver status
git status

# Adicionar mudanças
git add .

# Commit
git commit -m "feat: descrição da mudança"

# Push para repositório
git push origin main

# Pull do repositório
git pull origin main

# Ver histórico de commits
git log --oneline -10

# Reverter commit
git revert <commit-hash>

# Resetar para commit anterior
git reset --hard <commit-hash>
```

### Branches
```bash
# Ver branches
git branch

# Criar nova branch
git checkout -b feature/nome-feature

# Alternar para branch
git checkout feature/nome-feature

# Deletar branch
git branch -D feature/nome-feature

# Merge branch
git merge feature/nome-feature
```

---

## 📞 Suporte

Se encontrar problemas, verifique:

1. [MANUAL.md](docs/MANUAL.md) - Guia de uso
2. [DEPLOY.md](docs/DEPLOY.md) - Guia de deploy
3. [ROADMAP.md](docs/ROADMAP.md) - Funcionalidades
4. GitHub Issues - Problemas conhecidos
5. [Laravel Docs](https://laravel.com/docs) - Documentação oficial

---

## 📚 Recursos Úteis

- [Laravel Documentation](https://laravel.com/docs)
- [Vue.js Guide](https://vuejs.org/guide/)
- [Tailwind CSS](https://tailwindcss.com/docs)
- [PHP Manual](https://www.php.net/manual/)
- [MySQL Docs](https://dev.mysql.com/doc/)

---

**Última atualização**: 21 de maio de 2026
