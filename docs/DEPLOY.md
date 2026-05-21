# Deploy — CheckReport5

Guia completo de deploy do CheckReport5 para VPS Hostinger KVM 1 com CloudPanel, Nginx, PHP-FPM, MySQL e Cloudflare.

**Versão**: 1.0  
**Última atualização**: 21 de maio de 2026

---

## 📋 Pré-requisitos

### Ambiente de Produção

- ✅ VPS Hostinger KVM 1 (mínimo 2GB RAM, 2 vCPU)
- ✅ CloudPanel instalado e configurado
- ✅ Nginx + PHP-FPM 8.3+
- ✅ MySQL 8.0+
- ✅ Node.js 18+
- ✅ Composer 2.5+
- ✅ Git
- ✅ Cloudflare (opcional)
- ✅ Domínio configurado

### Conhecimentos Necessários

- SSH/Terminal
- Git básico
- Nginx configuration
- MySQL admin
- Variáveis de ambiente

---

## 🚀 Passo a Passo - Deploy em Hostinger

### 1. Acessar a VPS

```bash
ssh user@seu.vps.ip
```

Você receberá as credenciais de acesso no email de contratação.

### 2. Clonar o Repositório

```bash
cd /var/www
git clone https://github.com/seu-usuario/checkreport.git checkreport
cd checkreport
```

**Nota**: Se estiver usando repositório privado, configure SSH keys primeiro:

```bash
ssh-keygen -t rsa -b 4096
# Adicione a chave pública no GitHub
cat ~/.ssh/id_rsa.pub
```

### 3. Instalar Dependências

#### PHP/Laravel

```bash
# Instalar dependências do Composer (sem dev para produção)
composer install --no-dev --optimize-autoloader

# Gerar chave da aplicação
php artisan key:generate

# Publicar assets do Laravel
php artisan vendor:publish --tag=laravel-assets --force
```

#### Node.js/Frontend

```bash
# Instalar dependências do npm
npm install

# Compilar assets para produção
npm run build
```

### 4. Configurar Variáveis de Ambiente

```bash
# Copiar arquivo de exemplo
cp .env.example .env

# Editar com suas configurações
nano .env
```

**Configurações importantes a setar**:

```env
# Aplicação
APP_NAME="CheckReport"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seu-dominio.com.br
APP_TIMEZONE=America/Sao_Paulo

# Banco de dados
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=checkreport
DB_USERNAME=checkreport_user
DB_PASSWORD=SENHA_SUPER_SEGURA

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=file
QUEUE_CONNECTION=database

# Mail (configurar depois)
MAIL_MAILER=smtp
MAIL_HOST=smtp.seu-provedor.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@seu-dominio.com
MAIL_PASSWORD=sua-senha-email
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@seu-dominio.com
MAIL_FROM_NAME="CheckReport"

# App Settings
APP_LOCALE=pt_BR
```

### 5. Criar Banco de Dados

Via terminal MySQL:

```bash
# Acessar MySQL
mysql -u root -p

# Criar banco de dados
CREATE DATABASE checkreport;
CREATE USER 'checkreport_user'@'localhost' IDENTIFIED BY 'SENHA_SUPER_SEGURA';
GRANT ALL PRIVILEGES ON checkreport.* TO 'checkreport_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

Ou via CloudPanel (interface web):

1. Vá para **Databases** > **MySQL**
2. Clique em **Create Database**
3. Nome: `checkreport`
4. Usuário: `checkreport_user`
5. Senha: Use uma senha forte
6. Clique em **Create**

### 6. Executar Migrations

```bash
# Migrations e seeds
php artisan migrate --seed

# Criar link de storage (para uploads)
php artisan storage:link

# Limpar caches
php artisan cache:clear
php artisan config:clear
```

Após as migrations, o usuário admin será criado:
- **Email**: admin@checkreport.com
- **Senha**: Altere via CloudPanel ou artisan

### 7. Configurar Nginx

Via CloudPanel:

1. Vá para **Domains**
2. Selecione seu domínio
3. Clique em **SSL**
4. Ative **Let's Encrypt** (gratuito)
5. Vá para **Nginx**
6. Cole a configuração abaixo no **Custom Nginx Config**:

```nginx
# Adicionar após bloco server{} existente

# Reescrever para aplicação
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

# PHP
location ~ \.php$ {
    fastcgi_pass 127.0.0.1:9000;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    include fastcgi_params;
    
    # Headers adicionais
    fastcgi_hide_header X-Powered-By;
    fastcgi_param HTTPS on;
}

# Não cache API
location ~ ^/(api|admin|dashboard|login|register) {
    add_header Cache-Control "public, max-age=0, must-revalidate";
    try_files $uri $uri/ /index.php?$query_string;
}

# Cache assets estáticos (1 ano)
location ~ \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}

# Bloquear acesso a arquivos sensíveis
location ~ /\. {
    deny all;
}

location ~ ~$ {
    deny all;
}

# Bloquear acesso a storage privado
location ~* /storage/ {
    deny all;
}
```

### 8. Configurar PHP-FPM

No CloudPanel, vá para **PHP**:

- **Version**: 8.3+
- **Memory Limit**: 512M (mínimo)
- **Upload Max Filesize**: 100M
- **Post Max Size**: 100M
- **Max Execution Time**: 300s

### 9. Testar HTTPS

```bash
# Verificar SSL
curl -I https://seu-dominio.com.br

# Deve retornar 200 OK
```

### 10. Configurar Cron para Laravel

Via CloudPanel:

1. Vá para **Cron Jobs**
2. Adicione novo cron job:

```bash
* * * * * php /var/www/checkreport/artisan schedule:run >> /dev/null 2>&1
```

Ou manualmente:

```bash
# Editar crontab
crontab -e

# Adicionar linha
* * * * * cd /var/www/checkreport && php artisan schedule:run >> /dev/null 2>&1
```

---

## 🔒 Segurança

### 1. Permissões de Arquivo

```bash
cd /var/www/checkreport

# Owner do projeto
sudo chown -R www-data:www-data .

# Permissões de diretório
sudo chmod -R 755 .

# Permissões de arquivo
sudo find . -type f -exec chmod 644 {} \;

# Storage e bootstrap/cache com escrita
sudo chmod -R 775 storage bootstrap/cache
```

### 2. Arquivo .env

```bash
# O arquivo .env NÃO deve estar no repositório Git
# Verificar .gitignore
cat .gitignore | grep env

# Proteger arquivo .env
chmod 600 .env
```

### 3. Firewall

Via CloudPanel:

1. Vá para **Firewall**
2. Bloqueie tudo exceto:
   - Port 22 (SSH) - seu IP apenas
   - Port 80 (HTTP)
   - Port 443 (HTTPS)
   - Port 3306 (MySQL) - localhost apenas

### 4. Backup Automático

```bash
# Criar script de backup
nano /var/www/backup.sh
```

```bash
#!/bin/bash

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/var/backups/checkreport"

mkdir -p $BACKUP_DIR

# Backup database
mysqldump -u checkreport_user -p'SENHA' checkreport > $BACKUP_DIR/db_$DATE.sql.gz

# Backup arquivos
tar -czf $BACKUP_DIR/files_$DATE.tar.gz /var/www/checkreport

# Manter apenas últimos 30 dias
find $BACKUP_DIR -type f -mtime +30 -delete

echo "Backup realizado: $DATE"
```

```bash
# Dar permissão e adicionar ao cron
chmod +x /var/www/backup.sh
crontab -e
# Adicionar: 0 2 * * * /var/www/backup.sh
```

---

## ☁️ Configuração Cloudflare

### 1. Apontamento de DNS

1. Vá para **Cloudflare Dashboard**
2. Selecione seu domínio
3. Vá para **DNS**
4. Adicione records:

```
Type: A
Name: @
IPv4: seu.vps.ip
TTL: Auto

Type: A
Name: www
IPv4: seu.vps.ip
TTL: Auto
```

### 2. SSL/TLS

1. Vá para **SSL/TLS**
2. Selecione **Full (strict)**
3. Verifique certificado SSL na VPS via Let's Encrypt

```bash
# Renovar certificado (automático)
certbot renew --quiet

# Ou forçar renovação
certbot renew --force-renewal
```

### 3. Cache Rules

Crie regras no **Caching > Cache Rules**:

```
Path: /admin/*
Cache Level: Bypass

Path: /dashboard
Cache Level: Bypass

Path: /login
Cache Level: Bypass

Path: /api/*
Cache Level: Bypass

Path: /*.{jpg,jpeg,png,gif,css,js}
Cache Level: Cache Everything
Edge Cache TTL: 1 month
```

### 4. Page Rules (Alternativa para versões antigas)

Se usando Page Rules (deprecated):

| URL Pattern | Setting | Value |
|------------|---------|-------|
| `seu-dominio.com/admin/*` | Cache Level | Bypass |
| `seu-dominio.com/dashboard*` | Cache Level | Bypass |
| `seu-dominio.com/login*` | Cache Level | Bypass |

---

## 🔄 Atualizações e Manutenção

### Atualizar Aplicação

```bash
cd /var/www/checkreport

# Pull do repositório
git pull origin main

# Instalar dependências
composer install --no-dev --optimize-autoloader
npm install
npm run build

# Migrations (se houver)
php artisan migrate --force

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Monitorar Logs

```bash
# Logs Laravel
tail -f /var/www/checkreport/storage/logs/laravel.log

# Logs Nginx
tail -f /var/log/nginx/error.log

# Logs PHP-FPM
tail -f /var/log/php8.3-fpm.log
```

### Health Check

```bash
# Testar endpoint
curl -I https://seu-dominio.com.br/

# Testar API de saúde (se existir)
curl https://seu-dominio.com.br/health
```

---

## 📊 Monitoramento

### Verificar Recursos

```bash
# CPU e Memória
top

# Espaço em disco
df -h

# Conexões MySQL
mysql -u root -p -e "SHOW PROCESSLIST;"
```

### Performance

```bash
# Testar velocidade
curl -o /dev/null -s -w "%{time_total}" https://seu-dominio.com.br

# Benchmark com Apache Bench
ab -n 100 -c 10 https://seu-dominio.com.br/
```

---

## 🚨 Troubleshooting

### Erro 500 - Internal Server Error

```bash
# Verificar logs
tail -50 /var/www/checkreport/storage/logs/laravel.log

# Comum: Permissões de storage
sudo chmod -R 775 /var/www/checkreport/storage
sudo chown -R www-data:www-data /var/www/checkreport/storage

# Comum: Arquivo .env faltando
cp .env.example .env
php artisan key:generate
```

### Erro 502 - Bad Gateway (Nginx)

```bash
# Verificar PHP-FPM
sudo systemctl status php8.3-fpm

# Reiniciar
sudo systemctl restart php8.3-fpm
sudo systemctl restart nginx

# Verificar socket
ls -la /run/php/php8.3-fpm.sock
```

### Banco de dados não conecta

```bash
# Testar conexão
mysql -h 127.0.0.1 -u checkreport_user -p checkreport

# Verificar MySQL rodando
sudo systemctl status mysql

# Reiniciar
sudo systemctl restart mysql
```

### Muita memória sendo usada

```bash
# Aumentar limite PHP
sudo nano /etc/php/8.3/fpm/php.ini
# Alterar: memory_limit = 512M

# Aumentar limite Nginx
sudo nano /etc/nginx/nginx.conf
# Adicionar: worker_processes auto;
```

---

## 📞 Suporte e Recursos

- **Documentação Laravel**: https://laravel.com/docs
- **Documentação Nginx**: https://nginx.org/en/docs/
- **Hostinger Docs**: https://support.hostinger.com/
- **Cloudflare Docs**: https://developers.cloudflare.com/

---

## ✅ Checklist de Deploy

- [ ] VPS criada e acessível via SSH
- [ ] CloudPanel instalado
- [ ] Nginx + PHP-FPM configurado
- [ ] MySQL criado e acessível
- [ ] Domínio apontando para VPS
- [ ] Certificado SSL ativo
- [ ] Repositório Git clonado
- [ ] Dependências instaladas (Composer + NPM)
- [ ] Arquivo .env configurado
- [ ] Migrations executadas
- [ ] Admin user criado
- [ ] Storage link criado
- [ ] Permissões de arquivo corretas
- [ ] HTTPS funcionando
- [ ] Email configurado (opcional)
- [ ] Cron jobs ativo
- [ ] Backup automático ativo
- [ ] Monitoramento configurado
- [ ] Testes realizados
- [ ] Documentação atualizada

---

## 🎯 Próximas Melhorias

- [ ] CI/CD com GitHub Actions
- [ ] Monitoring com Prometheus
- [ ] Container com Docker
- [ ] Load balancer para alta disponibilidade
- [ ] Queue workers em background
- [ ] Redis para cache