# Roadmap — CheckReport5

## Status Geral
**Última atualização**: 21 de maio de 2026

### Progresso
- **Fase 1 (MVP)**: ~90% completo
- **Fase 2 (Melhorias)**: ~40% completo
- **Fase 3 (Monetização)**: ~50% completo
- **Fase 4 (Evolução)**: 0% (futuro)

---

## Fase 1 — MVP

### Backend & Database
- [x] Criar autenticação (Laravel Breeze + Inertia)
- [x] Criar Models (User, Plan, Customer, ChecklistTemplate, ChecklistSection, ChecklistField, ChecklistReport, ChecklistAnswer, ReportPhoto, AppSetting, UserPlan)
- [x] Criar Enums (UserRole, PlanTier, FieldType, ReportStatus)
- [x] Criar Migrations (11 tabelas)
- [x] Criar Services (PlanLimitService, ChecklistTemplateService, ChecklistResponseService, ReportPdfService)
- [x] Criar Policies (ChecklistReportPolicy, ChecklistTemplatePolicy, CustomerPolicy)
- [x] Criar Seeders (PlanSeeder, AdminSeeder)

### Controllers & Rotas
- [x] Criar Controllers (DashboardController, CustomerController, ChecklistTemplateController, ChecklistReportController, ProfileController)
- [x] Criar Admin Controllers (PlanController, UserController)
- [x] Configurar rotas autenticadas e públicas
- [x] Configurar middleware IsAdmin

### Frontend & Páginas
- [x] Instalar Laravel Breeze com Inertia + Vue 3 + TypeScript
- [x] Criar dashboard
- [x] Criar CRUD de clientes
- [x] Criar CRUD de modelos de checklist
- [x] Criar seções nos modelos
- [x] Criar campos personalizados
- [x] Criar preenchimento de checklist
- [x] Criar status dos relatórios
- [x] Criar painel admin
- [x] Criar CRUD de planos
- [x] Criar controle de limites por plano
- [x] Criar páginas públicas (Welcome, Pricing, Features, Terms, Privacy)
- [x] Criar robots.txt (básico)

### SEO & Público
- [x] Configurar Tailwind CSS
- [x] Configurar Vite
- [x] Criar estrutura de componentes Vue 3
- [ ] Criar sitemap.xml dinâmico
- [ ] Melhorar robots.txt (excluir admin, dashboard, reports privados)
- [ ] Adicionar metatags completas (Open Graph, Twitter Card, Schema.org)
- [ ] Implementar SEO em todas as páginas públicas

---

## Fase 2 — Melhorias

### Funcionalidades
- [x] Upload de fotos (estrutura criada em ReportPhoto)
- [x] Geração de relatório (ReportPdfService configurado com dompdf)
- [x] Link público de visualização (rota público criada)
- [ ] Templates globais opcionais (estrutura pronta, UI pendente)
- [ ] Relatórios básicos (apenas para admin)
- [ ] Personalização de cores e logo (AppSettings criado)
- [ ] Melhorar frontend com mais componentes Tailwind
- [ ] Adicionar validações mais robustas

### Testes
- [ ] Testes Unit (Services, Policies)
- [ ] Testes Feature (Autenticação, CRUD básico)
- [ ] Testes de limite de plano

---

## Fase 3 — Monetização

### Planos & Assinatura
- [x] Plano gratuito (Free: 3 templates, 10 reports/mês)
- [x] Planos pagos (Pro: R$49/mês, Plus: R$99/mês)
- [x] Controle de limites por plano
- [ ] Controle manual de assinaturas (apenas admin)
- [ ] Integração futura com Pix
- [ ] Integração futura com checkout externo (Stripe, etc)

### Admin
- [x] Dashboard Admin
- [x] Gerenciamento de Planos
- [x] Gerenciamento de Usuários
- [ ] Relatórios de uso (users, reports, templates)
- [ ] Configurações globais avançadas

---

## Fase 4 — Evolução (Futuro)

- [ ] PDF do relatório com branding do usuário
- [ ] Assinatura simples de recebimento
- [ ] Exportação CSV
- [ ] Multiusuário por conta (equipes)
- [ ] Biblioteca de templates
- [ ] Dashboard avançado com gráficos
- [ ] API REST para integrações
- [ ] Aplicativo mobile
- [ ] Sincronização offline
- [ ] Webhooks

---

## Próximos Passos (Imediatos)

1. ✅ Atualizar ROADMAP.md com progresso real
2. 🔄 Criar sitemap.xml dinâmico
3. 🔄 Melhorar robots.txt
4. 🔄 Adicionar metatags/SEO completo
5. 🔄 Implementar testes Unit/Feature
6. 🔄 Melhorar documentação (MANUAL.md, DEPLOY.md)
7. 🔄 Testar aplicação end-to-end