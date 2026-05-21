#!/bin/bash

# CheckReport5 - Setup Local Script
# Automatiza a configuração inicial do projeto

set -e

echo "🚀 CheckReport5 - Setup Local"
echo "=============================="
echo ""

# Cores
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

# 1. Verificar se .env existe
if [ ! -f ".env" ]; then
    echo -e "${YELLOW}📋 Criando arquivo .env...${NC}"
    cp .env.example .env
    echo -e "${GREEN}✓ Arquivo .env criado${NC}"
else
    echo -e "${GREEN}✓ Arquivo .env já existe${NC}"
fi

echo ""

# 2. Instalar dependências PHP
echo -e "${YELLOW}📦 Instalando dependências PHP...${NC}"
composer install
echo -e "${GREEN}✓ Dependências PHP instaladas${NC}"

echo ""

# 3. Instalar dependências Node
echo -e "${YELLOW}📦 Instalando dependências Node...${NC}"
npm install
echo -e "${GREEN}✓ Dependências Node instaladas${NC}"

echo ""

# 4. Gerar app key
echo -e "${YELLOW}🔑 Gerando chave da aplicação...${NC}"
php artisan key:generate
echo -e "${GREEN}✓ Chave gerada${NC}"

echo ""

# 5. Criar storage link
echo -e "${YELLOW}🔗 Criando storage link...${NC}"
php artisan storage:link 2>/dev/null || true
echo -e "${GREEN}✓ Storage link criado${NC}"

echo ""

# 6. Executar migrations
echo -e "${YELLOW}🗄️  Executando migrations...${NC}"
php artisan migrate --seed
echo -e "${GREEN}✓ Migrations executadas${NC}"

echo ""

# 7. Build frontend
echo -e "${YELLOW}🎨 Compilando assets frontend...${NC}"
npm run build
echo -e "${GREEN}✓ Assets compilados${NC}"

echo ""

# 8. Clear caches
echo -e "${YELLOW}🧹 Limpando caches...${NC}"
php artisan cache:clear
php artisan config:clear
php artisan view:clear
echo -e "${GREEN}✓ Caches limpos${NC}"

echo ""

# 9. Exibir credenciais padrão
echo -e "${YELLOW}================================${NC}"
echo -e "${GREEN}✓ Setup concluído com sucesso!${NC}"
echo ""
echo "📧 Credenciais padrão:"
echo "  Email: admin@checkreport.com"
echo "  Senha: Altere via: php artisan tinker"
echo ""
echo "🌐 Para iniciar o servidor:"
echo "  php artisan serve"
echo ""
echo "📦 Em outro terminal, execute:"
echo "  npm run dev"
echo ""
echo "Acesse: http://localhost:8000"
echo ""
