# Contexto del proyecto (para continuar en otra sesión)

## La tarea
- `instrucciones.txt`: auth con Laravel, módulo de Clientes con MVC y una plantilla propia para login, registro, recuperación de contraseña, registro de cliente y tabla de clientes. Video de máx. 5 min.
- **Guía obligatoria de desarrollo:** `C:\Users\jp_14\Downloads\README-LARAVEL.md`. El proyecto se adaptó para cumplirla:
  - `laravel/ui` con Bootstrap 5 y Vite (npm).
  - Un solo marco: `resources/views/layouts/app.blade.php`.
  - `Cliente` con solo `nombre` y `correo`. **Sin editar ni borrar.**
  - Base de datos `laravel_db`.
  - Rutas y controlador como dice la guía.
- El usuario pidió **dejar la menor cantidad de comentarios posible en el código**. La explicación va en `guion-video.md`.

## Estado actual: TERMINADO y funcionando con MySQL
- Proyecto: `clientes-app/`, con Laravel 13.35, PHP 8.3, Node 22, Vite 8, Bootstrap 5.3.8 y Sass.
- Guion: `guion-video.md`, ya actualizado a la estructura de la guía.

## Entorno
- Composer **no está instalado globalmente**. Se usó un `composer.phar` temporal; se puede bajar otra vez desde https://getcomposer.org/download/latest-stable/composer.phar.
- MySQL 8.0 corre como el servicio de Windows `MySQL80`.
  - Usuario `root`; su contraseña está en `clientes-app/.env`. **No hay que repetirla.**
  - Base activa: **`laravel_db`**.
  - Todavía existe la base vieja `clientes_db` (ya no se usa; se puede borrar).
  - La conexión "Proyecto" de Workbench (usuario `factech`) no tiene permisos para crear bases. No se usa.
- `MAIL_MAILER=log`: el enlace de recuperación queda en `storage/logs/laravel.log`.
- `.env`: `APP_LOCALE=es`, `APP_FAKER_LOCALE=es_ES`, `APP_NAME="Gestion de Clientes"`.
- Los archivos `CLAUDE.md` y `AGENTS.md` de `clientes-app` vienen con el esqueleto de Laravel (piden instalar Laravel Boost). Se decidió no instalarlo.

## Cómo levantar la aplicación (dos terminales, como dice la guía)
```
cd "C:\Users\jp_14\OneDrive\Documentos\desarrollo web\tarea lavarel\clientes-app"
# Terminal 1
npm run dev
# Terminal 2
php artisan migrate:fresh --seed   # opcional: reinicia las tablas y los datos de prueba
php artisan serve
```
- Abrir http://127.0.0.1:8000. Usuario de prueba: **admin@clientes.com** / **password**.
- El seeder crea ese usuario y 10 clientes.
- Ya se ejecutó `npm run build` (está en `public/build`), así que la página se ve aunque `npm run dev` no esté corriendo.
- **Después de cambiar Sass o JS hay que volver a ejecutar `npm run build`**, o tener `npm run dev` corriendo.

## Archivos (estado actual)
**Backend**
- `routes/web.php`: exactamente como la guía.
  - `/` devuelve la vista `welcome`; `Auth::routes()`; `/home`.
  - `Route::middleware('auth')->group`: `GET /clientes` → `create` (`clientes.create`) y `POST /clientes` → `store` (`clientes.store`).
- `app/Http/Controllers/ClienteController.php`: exactamente como la guía.
  - `create()`: `Cliente::latest()->get()` → vista `clientes.create`.
  - `store()`: valida nombre y correo (`unique:clientes,correo`) y redirige con `ok`.
- `app/Http/Controllers/HomeController.php`: el de `laravel/ui` (middleware `auth`), más `total` y `recientes` (5) para el inicio.
- `app/Http/Controllers/Auth/*`: generados por `laravel/ui`, sin comentarios.
- `app/Models/Cliente.php`: `$fillable = ['nombre', 'correo']` y `HasFactory`.
- Migración `database/migrations/2026_10_10_010450_create_clientes_table.php`: `id`, `nombre`, `correo` único y `timestamps`.
- `database/factories/ClienteFactory.php` y `database/seeders/DatabaseSeeder.php`.
- `lang/es/*.php` y `lang/es.json`: traducciones al español (atributos `nombre` y `correo`).
- `app/Providers/AppServiceProvider.php`: vacío.

**Frontend** (Vite; ya no se usan CDN, salvo Google Fonts para Inter)
- `vite.config.js`: entradas `resources/sass/app.scss` y `resources/js/app.js`. Se silencian las advertencias de deprecación de Sass.
- `package.json`: bootstrap, @popperjs/core, sass, axios y bootstrap-icons. Se quitó Tailwind.
- `resources/sass/_variables.scss`: variables de Bootstrap.
  - `$primary #1d1d1f`, `$success #34c759`, `$danger #ff3b30`, `$warning #ff9500`.
  - `$body-bg #f5f5f7`, `$border-color #d2d2d7`, `$input-bg #fff`.
  - Fuente Inter y `$enable-rounded: false`.
- `resources/sass/app.scss`: importa la fuente, las variables, Bootstrap y `template`.
- `resources/sass/_template.scss`: estilos de la plantilla (panel de dos columnas para invitados, menú lateral, barra superior, tarjetas, tabla, avatar, medidor de contraseña, responsive).
- `resources/js/bootstrap.js`: el de `laravel/ui`, sin comentarios (bootstrap + axios).
- `resources/js/app.js`: importa bootstrap e iconos; mostrar u ocultar contraseña, medidor de fortaleza, filtro en vivo de la tabla (`#filtro-clientes`, `#contador-clientes`) y botón del menú en celular.
- `resources/views/layouts/app.blade.php`: el **único layout**.
  - `@auth`: menú lateral con `<ul class="navbar-nav me-auto">` y el `@auth <li>` con `route('clientes.create')` (copiado de la guía), más la barra superior con logout (form `logout-form`).
  - `@else`: plantilla de dos paneles para invitados.
  - Los dos usan `@yield('content')`; los títulos usan `@yield('titulo')`.
- `resources/views/auth/*`: diseño propio; extienden `layouts.app`.
- `resources/views/welcome.blade.php`: botones para iniciar sesión y registrarse.
- `resources/views/home.blade.php`: el inicio.
- `resources/views/clientes/create.blade.php`: formulario + tabla, con la misma estructura que la guía (alerta `ok`, lista de errores, `@csrf`, `old()`, tabla ID/Nombre/Correo con `@forelse`) y el filtro JS.
- Se eliminaron: `layouts/auth.blade.php`, `clientes/index`, `edit`, `show`, `_form`, `public/css` y `public/js`.

## Decisiones de diseño del usuario (en orden)
1. Sin degradados: colores planos.
2. Tipografía corporativa: Inter.
3. Paleta de Apple. **No le gustó el azul `#0071e3`**, así que se usa la versión monocromática: grafito `#1d1d1f` / `#424245`, grises, verde y rojo solo para estados.
4. Todo rectangular, sin bordes redondeados.

## Verificado (después de adaptar a la guía)
- Con curl:
  - `/`, `/login`, `/register` y `/password/reset` responden 200.
  - `/clientes` sin sesión redirige a `/login`.
  - El login funciona.
  - Crear un cliente muestra el mensaje `ok`; las validaciones salen en español; un correo duplicado se rechaza.
- En Chrome: el login, el inicio y la pantalla de clientes se ven bien; el filtro JS y el menú desplegable funcionan.
