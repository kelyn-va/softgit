#!/usr/bin/env bash
# SCRIPT DE VERIFICACIÓN - Sistema de Reportes

echo "╔════════════════════════════════════════════════════════════════╗"
echo "║         VERIFICACIÓN DEL SISTEMA DE REPORTES                 ║"
echo "╚════════════════════════════════════════════════════════════════╝"
echo ""

# Color codes
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Contador
checks_passed=0
checks_total=0

# Función para verificar archivo
check_file() {
    checks_total=$((checks_total + 1))
    if [ -f "$1" ]; then
        echo -e "${GREEN}✓${NC} $1 existe"
        checks_passed=$((checks_passed + 1))
    else
        echo -e "${RED}✗${NC} $1 NO existe"
    fi
}

# Función para verificar directorio
check_dir() {
    checks_total=$((checks_total + 1))
    if [ -d "$1" ]; then
        echo -e "${GREEN}✓${NC} Directorio $1 existe"
        checks_passed=$((checks_passed + 1))
    else
        echo -e "${RED}✗${NC} Directorio $1 NO existe"
    fi
}

echo "📁 Verificando archivos creados..."
echo ""

check_file "app/Http/Controllers/ReportesController.php"
check_file "app/Http/Controllers/ReportesAdvancedController.php"
check_dir "resources/views/reportes"
check_file "resources/views/reportes/index.blade.php"

echo ""
echo "📚 Verificando documentación..."
echo ""

check_file "GUIA_RAPIDA.md"
check_file "GUIA_REPORTES.md"
check_file "ARQUITECTURA.md"
check_file "TROUBLESHOOTING.md"
check_file "DOCUMENTACION_REPORTES.md"
check_file "PERSONALIZACION_AVANZADA.php"
check_file "AGREGAR_AL_MENU.html"
check_file "RESUMEN_REPORTES.md"
check_file "INICIO_AQUI.txt"
check_file "RESUMEN_EJECUTIVO.txt"
check_file "RECURSOS_APRENDIZAJE.md"

echo ""
echo "════════════════════════════════════════════════════════════════"
echo -e "Verificaciones completadas: ${GREEN}$checks_passed / $checks_total${NC}"
echo "════════════════════════════════════════════════════════════════"
echo ""

if [ $checks_passed -eq $checks_total ]; then
    echo -e "${GREEN}✓ TODOS LOS ARCHIVOS ESTÁN EN SU LUGAR${NC}"
    echo ""
    echo "Próximos pasos:"
    echo "1. Ejecuta: php artisan serve"
    echo "2. Abre: http://localhost:8000/reportes"
    echo "3. ¡Prueba los reportes!"
else
    echo -e "${RED}✗ Falta verificar $((checks_total - checks_passed)) archivo(s)${NC}"
fi

echo ""
echo "Para más información, lee:"
echo "→ GUIA_RAPIDA.md"
echo "→ INICIO_AQUI.txt"
echo "→ RESUMEN_EJECUTIVO.txt"
