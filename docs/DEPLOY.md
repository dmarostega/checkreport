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