# Gestión de Clientes — Laravel

Proyecto en Laravel con:

- **Autenticación completa** (`laravel/ui` + Bootstrap 5): registro, inicio de sesión, cierre de sesión y recuperación de contraseña.
- **Módulo de clientes** (MVC): formulario para registrar `nombre` y `correo`, y tabla con los clientes guardados en MySQL. Solo se entra con sesión iniciada.
- **Plantilla propia** en Sass y JavaScript, compilada con Vite.

El código de la aplicación está en la carpeta **`clientes-app/`**.

---

## 1. Requisitos

Instala esto antes de empezar:

| Programa | Versión | Para qué |
| --- | --- | --- |
| [PHP](https://windows.php.net/download/) | 8.3 o mayor | Ejecutar Laravel |
| [Composer](https://getcomposer.org/download/) | 2.x | Instalar las dependencias de PHP |
| [Node.js](https://nodejs.org/) | 20.19+ o 22.12+ | Compilar CSS y JS con Vite |
| [MySQL](https://dev.mysql.com/downloads/) | 8.x | Base de datos (también sirve XAMPP/MariaDB) |
| [Git](https://git-scm.com/) | cualquiera | Clonar el repositorio |

Comprueba que estén instalados:

```bash
php -v
composer -V
node -v
npm -v
```

PHP necesita estas extensiones activas en su `php.ini`: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `curl` y `zip`. Para ver cuáles tienes, ejecuta `php -m`. Si falta alguna, quítale el `;` del inicio a la línea `extension=...` en el `php.ini`.

---

## 2. Clonar el proyecto

```bash
git clone https://github.com/jgarciap14/proyectolaravel.git
cd proyectolaravel/clientes-app
```

**Todos los comandos que siguen se ejecutan dentro de `clientes-app`.**

---

## 3. Instalar dependencias

```bash
composer install
npm install
```

Esto crea las carpetas `vendor/` y `node_modules/`, que no se suben al repositorio.

---

## 4. Configurar el archivo `.env`

El `.env` no viene en el repositorio porque guarda contraseñas. Créalo a partir del ejemplo:

```bash
# Windows (PowerShell o CMD)
copy .env.example .env

# Linux / macOS / Git Bash
cp .env.example .env
```

Genera la llave de la aplicación:

```bash
php artisan key:generate
```

Abre el `.env` y pon **tu** usuario y contraseña de MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

Si tu MySQL no tiene contraseña (por ejemplo, XAMPP), deja `DB_PASSWORD=` vacío.

---

## 5. Crear la base de datos

Hay dos formas. Usa la que te funcione.

### Opción A: que la cree Laravel (la más rápida)

```bash
php artisan migrate --seed
```

Si la base `laravel_db` no existe, Laravel pregunta:

```
The database 'laravel_db' does not exist on the 'mysql' connection.
Would you like to create it? (yes/no)
```

Responde **yes**. Esto crea la base y las tablas, y carga los datos de prueba.

> Para esto, el usuario de MySQL del `.env` debe tener permiso para crear bases de datos (`root` lo tiene).

### Opción B: crearla a mano

En MySQL Workbench, phpMyAdmin, HeidiSQL o la consola de MySQL, ejecuta:

```sql
CREATE DATABASE laravel_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Después crea las tablas y carga los datos:

```bash
php artisan migrate --seed
```

### Qué se crea

- **Tablas:** `users`, `password_reset_tokens`, `sessions`, `clientes`, `cache`, `jobs` y la de control `migrations`.
- **Datos de prueba** (con el seeder `database/seeders/DatabaseSeeder.php`):
  - Usuario **admin@clientes.com**, contraseña **password**.
  - 10 clientes de ejemplo.

Para borrar todo y volver a empezar con los datos de prueba:

```bash
php artisan migrate:fresh --seed
```

---

## 6. Levantar la aplicación

Se usan **dos terminales**, las dos dentro de `clientes-app`.

**Terminal 1:** compila el CSS y el JS. Se queda corriendo; no la cierres.

```bash
npm run dev
```

**Terminal 2:** levanta el servidor de Laravel.

```bash
php artisan serve
```

Abre en el navegador: **http://127.0.0.1:8000**

> Si no quieres tener `npm run dev` abierto, ejecuta una vez `npm run build` y después solo `php artisan serve`. Si cambias archivos de `resources/sass` o `resources/js`, vuelve a ejecutar `npm run build`.

---

## 7. Probar

| URL | Qué es |
| --- | --- |
| http://127.0.0.1:8000 | Bienvenida |
| http://127.0.0.1:8000/register | Crear usuario |
| http://127.0.0.1:8000/login | Iniciar sesión (admin@clientes.com / password) |
| http://127.0.0.1:8000/password/reset | Recuperar contraseña |
| http://127.0.0.1:8000/home | Inicio (pide sesión) |
| http://127.0.0.1:8000/clientes | Registrar y ver clientes (pide sesión) |

**Recuperar contraseña:** el correo no se envía de verdad. Con `MAIL_MAILER=log`, el enlace queda al final del archivo `storage/logs/laravel.log`. Cópialo y ábrelo en el navegador.

Para revisar las rutas:

```bash
php artisan route:list --except-vendor
```

---

## 8. Problemas comunes

| Error | Solución |
| --- | --- |
| `could not find driver` | Falta la extensión `pdo_mysql`. Actívala en el `php.ini`. |
| `SQLSTATE[HY000] [1045] Access denied for user` | El usuario o la contraseña del `.env` no son correctos. Corrígelos y ejecuta `php artisan config:clear`. |
| `SQLSTATE[HY000] [2002]` / `Connection refused` | MySQL está apagado. Enciéndelo (servicio `MySQL80` en Windows, o el botón de MySQL en XAMPP). |
| `SQLSTATE[42000] [1044] Access denied ... to database` | Tu usuario no puede crear bases de datos. Créala a mano (opción B) o usa `root`. |
| `Unknown database 'laravel_db'` | La base no existe. Sigue el paso 5. |
| `No application encryption key has been specified` | Ejecuta `php artisan key:generate`. |
| `Vite manifest not found` | No está corriendo `npm run dev`. Ejecútalo, o ejecuta `npm run build`. |
| `Failed to listen on 127.0.0.1:8000` | El puerto está ocupado. Usa `php artisan serve --port=8001`. |
| La página se ve sin estilos | Revisa que `npm run dev` esté corriendo y recarga con Ctrl + F5. |

---

## Estructura principal

```
clientes-app/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/                  # Login, registro y recuperación (laravel/ui)
│   │   ├── ClienteController.php  # create (formulario + lista) y store (guardar)
│   │   └── HomeController.php     # Página de inicio
│   └── Models/Cliente.php         # Modelo: nombre y correo
├── database/
│   ├── migrations/                # Tablas, incluida create_clientes_table
│   ├── factories/ClienteFactory.php
│   └── seeders/DatabaseSeeder.php # Usuario admin y clientes de prueba
├── lang/es/                       # Mensajes en español
├── resources/
│   ├── views/
│   │   ├── layouts/app.blade.php  # Layout único (plantilla)
│   │   ├── auth/                  # Login, registro y recuperación
│   │   ├── clientes/create.blade.php
│   │   ├── home.blade.php
│   │   └── welcome.blade.php
│   ├── sass/                      # Estilos (Bootstrap + plantilla)
│   └── js/app.js                  # JavaScript de la interfaz
└── routes/web.php                 # Rutas de auth, /home y /clientes
```
