# CheckReport5

[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-3-4FC08D?style=flat-square&logo=vue.js)](https://vuejs.org)
[![TypeScript](https://img.shields.io/badge/TypeScript-5.0-3178C6?style=flat-square&logo=typescript)](https://www.typescriptlang.org)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-00758F?style=flat-square&logo=mysql)](https://www.mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)

> **SaaS para criação de checklists, vistorias simples, relatórios operacionais e registros técnicos não regulados para prestadores de serviço.**

🔗 [Visitar Site](https://checkreport.app) • 📖 [Manual](docs/MANUAL.md) • 🚀 [Deploy](docs/DEPLOY.md) • 🗺️ [Roadmap](docs/ROADMAP.md)

---

## 📋 Sobre

CheckReport5 é uma plataforma SaaS moderna que permite prestadores de serviço, técnicos e pequenas empresas:

- ✅ **Criar modelos customizáveis** de checklists e vistorias
- ✅ **Preencher relatórios** diretamente em campo (web)
- ✅ **Adicionar evidências fotográficas** aos relatórios
- ✅ **Gerar PDFs profissionais** automaticamente
- ✅ **Compartilhar relatórios** via link público
- ✅ **Gerenciar clientes** centralizadamente
- ✅ **Controlar limites** por plano (Free/Pro/Plus)
- ✅ **Acessar painel admin** para gerenciar o sistema

### Personas

O CheckReport5 é ideal para:

1. **Técnicos de manutenção** - documentar vistorias e manutenções
2. **Instaladores** - registrar instalações e configurações
3. **Vistoriadores** - fazer inspeções e auditorias
4. **Prestadores de serviço residencial** - documentar trabalhos
5. **Pequenas empresas** - executar checklists de qualidade

---

## 🏗️ Tech Stack

### Backend
- **Laravel 13** - Framework PHP moderno
- **MySQL 8.0** - Banco de dados relacional
- **PHP 8.3+** - Engine backend

### Frontend
- **Vue.js 3** - Framework JavaScript reativo
- **TypeScript** - Type-safety para JavaScript
- **Tailwind CSS** - Utility-first CSS framework
- **Inertia.js** - SPA com server-side rendering

### Ferramentas
- **Vite** - Build tool ultrarrápido
- **Composer** - Package manager PHP
- **NPM** - Package manager JavaScript
- **Git** - Version control

---

## 🚀 Começando Rapidamente

### Requisitos

- Node.js 18+
- PHP 8.3+
- Composer 2.5+
- MySQL 8.0+
- Git

### Instalação Local

```bash
# Clonar repositório
git clone https://github.com/seu-usuario/checkreport.git
cd checkreport

# Instalar dependências PHP
composer install

# Instalar dependências JavaScript
npm install

# Copiar arquivo .env
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Executar migrations e seeds
php artisan migrate:seed

# Compilar assets
npm run build

# Criar link de storage
php artisan storage:link
```

### Executar Localmente

```bash
# Terminal 1: PHP Development Server
php artisan serve

# Terminal 2: Vite Development Server
npm run dev
```

Acesse: http://localhost:8000

### Credenciais Padrão

- **Email**: admin@checkreport.com
- **Senha**: Altere via comando: `php artisan tinker`

---

## 📚 Documentação

- 📖 **[Manual de Uso](docs/MANUAL.md)** - Guia completo de funcionalidades
- 🚀 **[Guia de Deploy](docs/DEPLOY.md)** - Instruções para VPS Hostinger
- 🗺️ **[Roadmap](docs/ROADMAP.md)** - Funcionalidades planejadas
- 📝 **[Prompt Base](PROMPT_BASE.md)** - Especificação do projeto

---

## 🏛️ Arquitetura

### Padrões de Design

- **SOLID Principles** - Código manutenível e escalável
- **Clean Code** - Padrões de codificação consistentes
- **MVC Pattern** - Model-View-Controller no Laravel
- **Repository Pattern** - Abstração de dados

### Estrutura de Diretórios

```
checkreport/
├── app/
│   ├── Enums/               # Tipos enumerados
│   ├── Models/              # Modelos Eloquent
│   ├── Http/
│   │   ├── Controllers/     # Controllers
│   │   ├── Requests/        # Form Requests
│   │   └── Middleware/      # Middlewares
│   ├── Services/            # Lógica de negócio
│   └── Policies/            # Autorização
├── database/
│   ├── migrations/          # Schemas do DB
│   ├── seeders/             # Dados iniciais
│   └── factories/           # Factories de teste
├── resources/
│   ├── js/
│   │   ├── Pages/           # Páginas Vue
│   │   ├── Layouts/         # Layouts
│   │   └── Components/      # Componentes
│   └── css/                 # Estilos
├── routes/                  # Definição de rotas
├── storage/                 # Uploads e logs
├── tests/                   # Suite de testes
└── config/                  # Configurações
```

---

## 📦 Funcionalidades Principais

### MVP (Versão Atual)

- ✅ Autenticação de usuários
- ✅ CRUD de clientes
- ✅ CRUD de modelos de checklist
- ✅ Seções e campos customizáveis
- ✅ Preenchimento de relatórios
- ✅ Upload de fotos
- ✅ Geração de PDF
- ✅ Link público de compartilhamento
- ✅ Planos com limites
- ✅ Painel admin
- ✅ SEO básico
- ✅ Testes Unit/Feature

### Próximas Versões

- 🔄 Assinatura simples de recebimento
- 🔄 Exportação CSV
- 🔄 Multiusuário por conta
- 🔄 Dashboard avançado
- 🔄 API REST
- 🔄 Aplicativo mobile
- 🔄 Integrações com terceiros

---

## 🔐 Segurança

### Implementado

- ✅ Autenticação com Laravel Breeze
- ✅ Autorização via Policies
- ✅ Isolamento de dados por usuário
- ✅ Proteção CSRF
- ✅ Rate limiting
- ✅ Validação de entrada
- ✅ Sanitização de saída
- ✅ Criptografia de senha (bcrypt)

### Recomendações

- Use HTTPS em produção
- Mantenha dependências atualizadas
- Realize auditorias regulares
- Backup automático de dados
- Monitor de logs de segurança

---

## 🧪 Testes

```bash
# Executar todos os testes
php artisan test

# Testes de Feature
php artisan test --filter Feature

# Testes de Unit
php artisan test --filter Unit

# Com coverage
php artisan test --coverage
```

### Testes Implementados

- ✅ **AuthenticationTest** - Login, logout, autenticação
- ✅ **PlanLimitTest** - Limites por plano
- ✅ **DataIsolationTest** - Isolamento de dados entre usuários
- ✅ **ReportPdfServiceTest** - Geração de PDF

---

## 🌐 Deploy

### Opções de Deploy

1. **VPS Hostinger** - Recomendado (veja [DEPLOY.md](docs/DEPLOY.md))
2. **Heroku** - Fácil e rápido
3. **AWS** - Escalável
4. **DigitalOcean** - Custo-benefício
5. **Docker** - Container (futuro)

### Deploy Rápido em Hostinger

```bash
# 1. SSH na VPS
ssh user@seu.vps.ip

# 2. Clonar repositório
cd /var/www && git clone https://github.com/seu-usuario/checkreport.git

# 3. Instalar dependências
composer install --no-dev --optimize-autoloader
npm install && npm run build

# 4. Configurar ambiente
cp .env.example .env
php artisan key:generate

# 5. Configurar banco de dados
# (Criar via CloudPanel)

# 6. Executar migrations
php artisan migrate --seed

# 7. Configurar Nginx (via CloudPanel)
# (Veja detalhes em DEPLOY.md)
```

Veja [docs/DEPLOY.md](docs/DEPLOY.md) para instruções detalhadas.

---

## 📊 Performance

### Otimizações Implementadas

- ✅ Lazy loading de componentes Vue
- ✅ Query optimization com Eloquent
- ✅ Asset minification (CSS/JS)
- ✅ Compression gzip
- ✅ Cache de banco de dados
- ✅ CDN ready com Cloudflare

### Benchmarks

- Tempo de carregamento: ~800ms (3G)
- Lighthouse Score: ~90
- Core Web Vitals: Bom

---

## 🤝 Contribuição

Contribuições são bem-vindas! Por favor:

1. Faça fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

---

## 📝 Licença

Este projeto está sob a licença MIT. Veja [LICENSE](LICENSE) para detalhes.

---

## ⚖️ Disclaimer Legal

**IMPORTANTE**: CheckReport5 é uma ferramenta de organização e registro. Ele **NÃO substitui**:

- ❌ Responsabilidade técnica
- ❌ Assinatura profissional ou certificação
- ❌ ART (Anotação de Responsabilidade Técnica)
- ❌ Laudo jurídico
- ❌ Laudo médico
- ❌ Laudo de engenharia
- ❌ Qualquer documento regulado

**A responsabilidade pelo conteúdo dos relatórios gerados é inteiramente do usuário/profissional.**

Consulte a [Política de Privacidade](docs/PRIVACY.md) e [Termos de Uso](docs/TERMS.md) para detalhes completos.

---

## 📞 Suporte

- 📧 **Email**: support@checkreport.app
- 💬 **Chat**: Em breve
- 📖 **FAQ**: https://checkreport.app/faq
- 🐛 **Issues**: [GitHub Issues](https://github.com/seu-usuario/checkreport/issues)

---

## 🙏 Agradecimentos

- [Laravel Community](https://laravel.com)
- [Vue.js Team](https://vuejs.org)
- [Tailwind CSS](https://tailwindcss.com)
- Todos os contribuidores

---

## 📈 Status do Projeto

| Componente | Status | Progresso |
|-----------|--------|-----------|
| **Fase 1 - MVP** | ✅ Completo | 90% |
| **Fase 2 - Melhorias** | 🔄 Em Progresso | 40% |
| **Fase 3 - Monetização** | 🔄 Em Progresso | 50% |
| **Fase 4 - Evolução** | ⏳ Planejamento | 0% |

---

**Desenvolvido com ❤️ para prestadores de serviço**

Última atualização: 21 de maio de 2026