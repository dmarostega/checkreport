# Deploy — CheckReport5

Guia mínimo de deploy para VPS Hostinger KVM 1 com CloudPanel, Nginx, PHP-FPM, MySQL, Node.js, Composer e Cloudflare.

## Ambiente previsto

- VPS Hostinger KVM 1
- CloudPanel
- Nginx
- PHP-FPM
- MySQL
- Composer
- Node.js
- NPM
- Git
- Cloudflare

## Instalação

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link


## Cloudflare

Este projeto pode ser publicado atrás do Cloudflare.

Configuração recomendada:

- DNS apontando para o IP da VPS.
- Proxy ativado, se desejado.
- SSL/TLS em modo Full ou Full (strict), preferencialmente Full (strict) quando houver certificado válido na VPS.
- Não usar Flexible SSL em produção Laravel, para evitar problemas de redirect HTTPS, mixed content e loop de redirecionamento.
- Garantir que `APP_URL` esteja configurado com `https://seudominio.com.br`.
- Após alterações de DNS, SSL ou build front-end, limpar cache do Cloudflare se necessário.

## Atenção com cache

Evitar cache agressivo em rotas autenticadas, painel admin, dashboard e APIs.

Rotas que não devem ser cacheadas:

- `/login`
- `/register`
- `/dashboard`
- `/admin/*`
- `/api/*`
- rotas autenticadas em geral

Páginas públicas como Home, Preços, Recursos, Termos e Política de Privacidade podem usar cache com cuidado.