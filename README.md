# Proyecto Laravel con Filament

## Instalación y Configuración

Sigue estos pasos para instalar y configurar el proyecto correctamente.

### 1. Copiar el archivo de entorno
```bash
cp .env.example .env
```

### 2. Instalar dependencias con Composer
```bash
composer install
```

### 3. Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 4. Ejecutar las migraciones
```bash
php artisan migrate
```

### 5. Ejecutar los seeders
```bash
php artisan db:seed --class=FilamentUserSeeder
```

### 6. Crear enlaces simbólicos para almacenamiento
```bash
ln -s $(pwd)/storage/app/private/filament_exports $(pwd)/public/exports
php artisan storage:link
```

### 7. Iniciar el servidor de desarrollo
```bash
php artisan serve
```

### 8. Acceder al panel de administración
Abre tu navegador y ve a:
```
http://127.0.0.1:8000/admin
```
