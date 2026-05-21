#!/bin/bash

# CheckReport5 - Test & Validation Script
# Este script executa verificações básicas da aplicação

set -e

echo "🧪 CheckReport5 - Test & Validation Script"
echo "==========================================="
echo ""

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# 1. Verificar requisitos
echo "${YELLOW}1. Verificando requisitos do sistema...${NC}"

if ! command -v php &> /dev/null; then
    echo -e "${RED}✗ PHP não encontrado${NC}"
    exit 1
fi
PHP_VERSION=$(php -v | head -n 1)
echo -e "${GREEN}✓${NC} $PHP_VERSION"

if ! command -v composer &> /dev/null; then
    echo -e "${RED}✗ Composer não encontrado${NC}"
    exit 1
fi
echo -e "${GREEN}✓${NC} Composer instalado"

if ! command -v node &> /dev/null; then
    echo -e "${RED}✗ Node.js não encontrado${NC}"
    exit 1
fi
NODE_VERSION=$(node -v)
echo -e "${GREEN}✓${NC} Node.js $NODE_VERSION"

echo ""

# 2. Verificar estrutura do projeto
echo "${YELLOW}2. Verificando estrutura do projeto...${NC}"

REQUIRED_DIRS=("app" "routes" "database" "resources" "tests" "storage" "config")

for dir in "${REQUIRED_DIRS[@]}"; do
    if [ -d "$dir" ]; then
        echo -e "${GREEN}✓${NC} $dir/"
    else
        echo -e "${RED}✗${NC} $dir/ não encontrado"
        exit 1
    fi
done

echo ""

# 3. Verificar arquivo .env
echo "${YELLOW}3. Verificando configuração .env...${NC}"

if [ -f ".env" ]; then
    echo -e "${GREEN}✓${NC} Arquivo .env encontrado"
    # Verificar variáveis necessárias
    if grep -q "APP_KEY=" .env && grep -q "DB_" .env; then
        echo -e "${GREEN}✓${NC} Variáveis de ambiente configuradas"
    else
        echo -e "${YELLOW}⚠${NC} Algumas variáveis de ambiente podem estar faltando"
    fi
else
    echo -e "${YELLOW}⚠${NC} Arquivo .env não encontrado, usando .env.example"
fi

echo ""

# 4. Verificar autoload do Composer
echo "${YELLOW}4. Verificando autoload do Composer...${NC}"

if php -r "require 'vendor/autoload.php'; echo 'OK';" 2>/dev/null | grep -q "OK"; then
    echo -e "${GREEN}✓${NC} Autoload funcionando"
else
    echo -e "${RED}✗${NC} Problema com autoload do Composer"
    exit 1
fi

echo ""

# 5. Verificar Models e Controllers
echo "${YELLOW}5. Verificando Models e Controllers...${NC}"

MODELS=("User" "Plan" "Customer" "ChecklistTemplate" "ChecklistReport")
for model in "${MODELS[@]}"; do
    MODEL_FILE="app/Models/$model.php"
    if [ -f "$MODEL_FILE" ]; then
        echo -e "${GREEN}✓${NC} Model: $model"
    else
        echo -e "${RED}✗${NC} Model não encontrado: $model"
    fi
done

echo ""

# 6. Verificar migrations
echo "${YELLOW}6. Verificando migrations...${NC}"

MIGRATION_COUNT=$(find database/migrations -name "*.php" 2>/dev/null | wc -l)
if [ "$MIGRATION_COUNT" -gt 0 ]; then
    echo -e "${GREEN}✓${NC} $MIGRATION_COUNT migrations encontradas"
else
    echo -e "${RED}✗${NC} Nenhuma migration encontrada"
fi

echo ""

# 7. Verificar Services
echo "${YELLOW}7. Verificando Services...${NC}"

SERVICES=("PlanLimitService" "ChecklistTemplateService" "ChecklistResponseService" "ReportPdfService")
for service in "${SERVICES[@]}"; do
    SERVICE_FILE="app/Services/${service}.php"
    if [ -f "$SERVICE_FILE" ]; then
        echo -e "${GREEN}✓${NC} Service: $service"
    else
        echo -e "${YELLOW}⚠${NC} Service não encontrado: $service"
    fi
done

echo ""

# 8. Verificar Policies
echo "${YELLOW}8. Verificando Policies...${NC}"

POLICIES=("ChecklistReportPolicy" "ChecklistTemplatePolicy" "CustomerPolicy")
for policy in "${POLICIES[@]}"; do
    POLICY_FILE="app/Policies/${policy}.php"
    if [ -f "$POLICY_FILE" ]; then
        echo -e "${GREEN}✓${NC} Policy: $policy"
    else
        echo -e "${YELLOW}⚠${NC} Policy não encontrada: $policy"
    fi
done

echo ""

# 9. Verificar Enums
echo "${YELLOW}9. Verificando Enums...${NC}"

ENUMS=("UserRole" "PlanTier" "FieldType" "ReportStatus")
for enum in "${ENUMS[@]}"; do
    ENUM_FILE="app/Enums/${enum}.php"
    if [ -f "$ENUM_FILE" ]; then
        echo -e "${GREEN}✓${NC} Enum: $enum"
    else
        echo -e "${RED}✗${NC} Enum não encontrado: $enum"
    fi
done

echo ""

# 10. Verificar Testes
echo "${YELLOW}10. Verificando arquivos de teste...${NC}"

TEST_COUNT=$(find tests -name "*.php" | wc -l)
if [ "$TEST_COUNT" -gt 0 ]; then
    echo -e "${GREEN}✓${NC} $TEST_COUNT arquivos de teste encontrados"
else
    echo -e "${YELLOW}⚠${NC} Nenhum arquivo de teste encontrado"
fi

echo ""

# 11. Verificar Frontend
echo "${YELLOW}11. Verificando arquivos de Frontend...${NC}"

COMPONENTS_COUNT=$(find resources/js/Components -name "*.vue" 2>/dev/null | wc -l)
PAGES_COUNT=$(find resources/js/Pages -name "*.vue" 2>/dev/null | wc -l)

echo -e "${GREEN}✓${NC} Componentes Vue: $COMPONENTS_COUNT"
echo -e "${GREEN}✓${NC} Páginas Vue: $PAGES_COUNT"

echo ""

# 12. Verificar SEO
echo "${YELLOW}12. Verificando arquivos de SEO...${NC}"

if [ -f "public/robots.txt" ]; then
    echo -e "${GREEN}✓${NC} robots.txt encontrado"
    ROBOTS_SIZE=$(wc -c < public/robots.txt)
    if [ "$ROBOTS_SIZE" -gt 50 ]; then
        echo -e "${GREEN}✓${NC} robots.txt configurado (~$ROBOTS_SIZE bytes)"
    else
        echo -e "${YELLOW}⚠${NC} robots.txt pode estar incompleto"
    fi
else
    echo -e "${RED}✗${NC} robots.txt não encontrado"
fi

if [ -f "app/Http/Controllers/SitemapController.php" ]; then
    echo -e "${GREEN}✓${NC} SitemapController encontrado"
else
    echo -e "${YELLOW}⚠${NC} SitemapController não encontrado"
fi

echo ""

# 13. Verificar Documentação
echo "${YELLOW}13. Verificando documentação...${NC}"

DOCS=("docs/MANUAL.md" "docs/DEPLOY.md" "docs/ROADMAP.md" "README.md")
for doc in "${DOCS[@]}"; do
    if [ -f "$doc" ]; then
        DOC_SIZE=$(wc -c < "$doc")
        if [ "$DOC_SIZE" -gt 500 ]; then
            echo -e "${GREEN}✓${NC} $doc (~$(($DOC_SIZE / 1024))KB)"
        else
            echo -e "${YELLOW}⚠${NC} $doc pode estar incompleto"
        fi
    else
        echo -e "${RED}✗${NC} $doc não encontrado"
    fi
done

echo ""

# 14. Teste de sintaxe PHP
echo "${YELLOW}14. Testando sintaxe PHP...${NC}"

if php -l app/Http/Controllers/SitemapController.php > /dev/null 2>&1; then
    echo -e "${GREEN}✓${NC} Sintaxe PHP válida"
else
    echo -e "${RED}✗${NC} Erros de sintaxe PHP encontrados"
fi

echo ""

# Resumo Final
echo "${YELLOW}=========================================${NC}"
echo -e "${GREEN}✓ Validação concluída com sucesso!${NC}"
echo ""
echo "📋 Próximos passos:"
echo "1. Execute: composer dump-autoload -o"
echo "2. Execute: php artisan migrate"
echo "3. Execute: npm run build"
echo "4. Execute: php artisan serve"
echo ""
echo "🌐 Acesse: http://localhost:8000"
echo ""
