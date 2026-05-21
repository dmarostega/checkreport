Tasks - CheckReport Implementation
Fase 1: Configuração do Ambiente e Ferramentas Base
[x] Instalar e configurar Laravel Breeze (Inertia, Vue, TypeScript).
[x] Configurar banco de dados local (MySQL) no .env.
[x] Configurar Vite, Tailwind CSS e aliases (se não estiverem pré-configurados pelo Breeze).
[x] Instalar pacote de PDF (barryvdh/laravel-dompdf).
Fase 2: Estrutura de Banco de Dados e Modelos
[x] Criar Enums (UserRole, PlanTier, FieldType, ReportStatus).
[x] Criar e configurar Models/Migrations para Plan, UserPlan.
[x] Adicionar roles ao User Model/Migration.
[x] Criar Models/Migrations para Customer.
[x] Criar Models/Migrations para ChecklistTemplate, ChecklistSection, ChecklistField.
[x] Criar Models/Migrations para ChecklistReport, ChecklistAnswer, ReportPhoto.
[x] Criar Models/Migrations para AppSetting.
[x] Criar e rodar Factories e Seeders iniciais.
Fase 3: Camada de Serviços, Policies e Requests (SOLID)
[x] Criar PlanLimitService.
[x] Criar ChecklistTemplateService.
[x] Criar ChecklistResponseService.
[x] Criar ReportPdfService.
[x] Configurar Policies (Isolamento de usuário).
[x] Criar Form Requests de validação.
Fase 4: Painel Admin
[x] Configurar rotas e middleware Admin.
[x] Dashboard Admin.
[x] CRUD de Planos e Configurações (AppSettings).
[x] Gerenciamento de Usuários.
Fase 5: Dashboard do Usuário
[x] Dashboard (Resumo, atalhos).
[x] CRUD de Clientes.
[x] CRUD e Construtor de Modelos de Checklist.
[x] Preenchimento de Relatórios e upload de fotos.
[x] Geração e visualização de PDF/Link Público.
Fase 6: Front-end Público e SEO
[x] Landing Page / Home.
[x] Páginas Institucionais (Recursos, Preços, Termos, Privacidade).
[ ] SEO (robots.txt, sitemap.xml, metatags).
Fase 7: Documentação e Testes
[ ] Atualizar README.md.
[ ] Criar docs/MANUAL.md.
[ ] Criar docs/DEPLOY.md.
[ ] Testes Unitários/Features básicos.