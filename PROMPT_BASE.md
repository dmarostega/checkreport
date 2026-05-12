# Prompt Codex — CheckReport5

Este arquivo contém o prompt principal usado para orientar a implementação do projeto no Codex.

## Produto

CheckReport5 é um SaaS para prestadores que precisam criar checklists, vistorias simples, relatórios operacionais e registros técnicos não regulados.

## Stack obrigatória

- Laravel 13
- Vue.js 3
- TypeScript
- MySQL
- Tailwind CSS
- Vite
- Inertia.js

## Regras principais

- Seguir SOLID e Clean Code.
- Usar Controllers finos.
- Usar Services para regras de negócio.
- Usar Form Requests para validação.
- Usar Policies para autorização.
- Usar Enums para tipos de campos, status de relatórios e roles.
- Criar painel admin.
- Criar CRUD de planos.
- Criar pelo menos um Plano Gratuito.
- Criar SEO básico.
- Criar `public/robots.txt`.
- Criar `public/sitemap.xml`.
- Criar manual em Markdown.
- Preparar deploy para VPS Hostinger KVM 1 com CloudPanel, Nginx, PHP-FPM, MySQL e Cloudflare.

## Observação importante

O sistema deve ser apresentado como ferramenta de registro, checklist e organização de relatórios.

Não deve prometer validade jurídica, laudo técnico regulamentado, ART, assinatura digital avançada, laudo de engenharia, laudo médico ou qualquer documento regulado.

A responsabilidade técnica pelo conteúdo do relatório é do usuário/profissional.

## Prompt completo

Você é um especialista em Laravel 13, Vue.js 3, TypeScript, MySQL, SaaS para prestação de serviços, SOLID, Clean Code e geração de documentos.

Crie um SaaS chamado "CheckLaudo", focado em prestadores que precisam preencher checklists, vistorias simples, relatórios técnicos e laudos operacionais não regulados.

Stack:
- Laravel 13
- Vue.js 3
- TypeScript
- MySQL
- Tailwind CSS
- Vite
- Inertia.js com Vue 3
- Autenticação compatível com Laravel 13

Objetivo:
Permitir criar modelos de checklist, preencher inspeções e gerar relatório/PDF.

Atenção legal:
- O sistema não deve prometer validade técnica, jurídica, ART, laudo de engenharia, laudo médico ou documento regulado.
- Incluir disclaimer: a responsabilidade técnica pelo conteúdo é do usuário/profissional.
- O sistema é apenas ferramenta de registro e organização.

Personas:
1. Técnico de manutenção.
2. Instalador de câmeras.
3. Vistoriador informal.
4. Prestador de serviços residenciais.
5. Empresa pequena que precisa de checklist de execução.

Funcionalidades:
- Cadastro/login.
- Dashboard:
  - checklists preenchidos;
  - relatórios gerados;
  - modelos ativos;
  - limite do plano.
- CRUD de clientes.
- CRUD de modelos de checklist.
- Modelo de checklist deve permitir:
  - seções;
  - perguntas;
  - tipos de resposta:
    - texto;
    - sim/não;
    - número;
    - seleção;
    - foto;
    - observação.
- Preencher checklist para cliente/local.
- Adicionar fotos.
- Gerar relatório/PDF.
- Status do relatório:
  - rascunho;
  - concluído;
  - enviado;
  - arquivado.
- Link público para visualizar relatório final.
- Cores configuráveis por variáveis.

Painel admin:
- Role admin.
- CRUD de planos.
- CRUD de usuários.
- Alteração manual de plano.
- Configurações globais:
  - nome;
  - domínio;
  - e-mail;
  - cores;
  - SEO;
  - limites.
- Admin pode criar templates globais opcionais.
- Relatórios:
  - usuários por plano;
  - relatórios gerados;
  - templates criados.

Planos:
- Gratuito:
  - até 3 modelos;
  - até 10 relatórios por mês.
- Pro:
  - modelos ilimitados;
  - até 200 relatórios por mês;
  - PDF;
  - fotos.
- Plus:
  - relatórios ilimitados;
  - personalização visual;
  - templates avançados.

SEO:
- Home.
- Recursos.
- Preços.
- Termos.
- Privacidade.
- Implementar metatags, canonical, Open Graph, Twitter Card.
- Schema.org SoftwareApplication.
- Criar public/robots.txt.
- Criar public/sitemap.xml.
- Não indexar relatórios com token, dashboard ou admin.

Arquitetura:
- Services:
  - ChecklistTemplateService;
  - ChecklistResponseService;
  - ReportPdfService;
  - PlanLimitService.
- Form Requests.
- Policies.
- Enums:
  - FieldType;
  - ReportStatus;
  - UserRole.
- Seeders:
  - admin;
  - planos;
  - configs;
  - templates globais básicos.
- Factories.
- Testes:
  - criação de modelo;
  - preenchimento de checklist;
  - limite do plano gratuito;
  - geração de relatório;
  - isolamento por usuário.

Entidades:
- User
- Plan
- UserPlan
- Customer
- ChecklistTemplate
- ChecklistSection
- ChecklistField
- ChecklistReport
- ChecklistAnswer
- ReportPhoto
- AppSetting

Manual:
- Criar docs/MANUAL.md.
- Explicar:
  - criação de modelos;
  - preenchimento;
  - geração de relatório;
  - limitações legais;
  - planos;
  - admin.
- Criar README.md.
- Criar docs/DEPLOY.md para VPS Hostinger KVM 1.

Não implementar assinatura digital avançada, validade jurídica ou integrações externas no MVP.


### Regras globais do projeto:

1. Stack obrigatória:
   - Laravel 13
   - Vue.js 3
   - TypeScript
   - MySQL
   - Tailwind CSS
   - Vite

2. Arquitetura:
   - Seguir SOLID, Clean Code e separação de responsabilidades.
   - Controllers devem ser finos.
   - Usar Form Requests para validação.
   - Usar Policies para autorização.
   - Usar Services/Actions para regras de negócio.
   - Usar Enums para status, roles e tipos fixos.
   - Usar migrations com foreign keys, índices e constraints.
   - Usar seeders para dados iniciais.
   - Usar factories e testes mínimos.

3. SaaS:
   - Todo projeto deve ter planos.
   - Deve existir no mínimo Plano Gratuito.
   - Planos devem ser configuráveis pelo painel admin.
   - Admin deve poder alterar plano do usuário manualmente.
   - Não implementar pagamento online no MVP.
   - Preparar estrutura para futura integração com cobrança.

4. Admin:
   - Criar role admin.
   - Criar painel admin protegido.
   - Admin deve gerenciar usuários, planos e configurações globais.
   - Admin deve visualizar relatórios básicos.

5. SEO:
   - Criar páginas públicas:
     - Home
     - Recursos
     - Preços
     - Termos de Uso
     - Política de Privacidade
   - Implementar title, meta description, canonical, Open Graph e Twitter Card.
   - Criar Schema.org SoftwareApplication quando aplicável.
   - Criar public/robots.txt.
   - Criar public/sitemap.xml.
   - Não indexar rotas autenticadas, admin, dashboard ou dados privados.

6. Front-end:
   - Usar Vue 3 com TypeScript.
   - Componentizar telas e elementos reutilizáveis.
   - Usar Tailwind CSS.
   - Cores principais devem ser configuráveis via variáveis CSS.
   - Evitar cores hardcoded espalhadas no projeto.
   - Criar layout público, layout autenticado e layout admin.

7. Deploy:
   - Preparar para VPS KVM 1 da Hostinger com Nginx, PHP-FPM, MySQL e Node.
   - Criar docs/DEPLOY.md.
   - Documentar:
     - composer install
     - npm install
     - npm run build
     - php artisan migrate --seed
     - php artisan storage:link
     - permissões
     - configuração .env
     - cache de config, routes e views

8. Documentação:
   - Criar / Atualizart README.md técnico.
   - Criar / Atualizart docs/MANUAL.md para uso do sistema.
   - Criar / Atualizart docs/ROADMAP.md com melhorias futuras.
   - Criar / Atualizart docs/DEPLOY.md.

9. Segurança:
   - Isolar dados por usuário.
   - Nunca permitir que um usuário acesse dados de outro.
   - Validar permissões via Policies.
   - Proteger rotas admin.
   - Não expor dados privados no sitemap.
   - Não indexar páginas privadas.

10. Qualidade:
   - Criar testes mínimos para regras principais.
   - Evitar overengineering.
   - Priorizar MVP funcional, limpo, simples e evolutivo.