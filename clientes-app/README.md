# Gestión de Clientes — Laravel

Las instrucciones para instalar, crear la base de datos y levantar el proyecto están en el [README principal](../README.md).

Resumen rápido (dentro de esta carpeta):

```bash
composer install
npm install
copy .env.example .env      # en Linux/macOS: cp .env.example .env
php artisan key:generate
# Poner usuario y contraseña de MySQL en .env
php artisan migrate --seed  # responde "yes" si pregunta por crear laravel_db
npm run dev                 # terminal 1
php artisan serve           # terminal 2
```

Usuario de prueba: **admin@clientes.com** / **password**
