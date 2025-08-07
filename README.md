Claro, aquí tienes un archivo `README.md` con las instrucciones que me proporcionaste, pero estructurado para que sea más claro y fácil de seguir.

-----

# 🚀 Proyecto: Docker, Laravel y Reverb

Este proyecto utiliza **Docker Compose** para orquestar los servicios necesarios para ejecutar una aplicación de Laravel. Incluye una base de datos MySQL, un servidor web Nginx, un contenedor para la aplicación PHP y un servidor **Laravel Reverb** para WebSockets.

## 📝 Requisitos

  - **Docker** y **Docker Compose** instalados.

## ⚙️ Configuración inicial

1.  **Levanta los contenedores**:
    Desde el src del proyecto, ejecuta el siguiente comando para iniciar todos los servicios:

    ```bash
    docker compose up -d
    ```

    Esto creará y arrancará los contenedores `nginx`, `laravel-app`, `db` y mas.

2.  **Configura el archivo `.env`**:
    Asegúrate de que el archivo `.env` esté correctamente configurado con las variables de entorno de tu proyecto. Si no existe, puedes crearlo copiando el archivo `.env.example`.

## ✅ Pasos para levantar el proyecto

Una vez que los contenedores estén en ejecución y el `.env` esté configurado, sigue estos pasos para preparar tu aplicación de Laravel:

### 1\. 📦 Instalar dependencias

Ejecuta este comando para instalar las dependencias de Composer dentro del contenedor `laravel-app`:

```bash
docker compose exec laravel-app composer install
```

### 2\. 🔑 Generar la clave de la aplicación

Genera una nueva clave de aplicación para Laravel. Esto actualizará automáticamente la variable `APP_KEY` en tu archivo `.env`:

```bash
docker compose exec laravel-app php artisan key:generate
```

### 3\. 🛠️ Ejecutar migraciones

Crea las tablas de tu base de datos con el siguiente comando:

```bash
docker compose exec laravel-app php artisan migrate
```

Las migraciones se ejecutarán en la base de datos MySQL (`db`) que ya está corriendo.

### 4\. ✍️ Verificar permisos (opcional)

Es recomendable asegurarse de que los directorios `storage` y `bootstrap/cache` tengan los permisos correctos. Puedes hacerlo desde tu sistema host o dentro del contenedor:

```bash
chmod -R 775 storage bootstrap/cache
```

O, para hacerlo desde dentro del contenedor:

```bash
docker compose exec laravel-app bash
chmod -R 775 storage bootstrap/cache
exit
```

-----

## 🌐 Acceso a los servicios

Una vez que el proyecto esté levantado y configurado, puedes acceder a los diferentes servicios a través de las siguientes URLs:

  - **Aplicación Laravel**: `http://localhost:8089` (o el puerto que hayas mapeado en tu `docker-compose.yml`)
  - **Laravel Reverb**: `http://localhost:8080`
  - **phpMyAdmin**: `http://localhost:8081`

> **Nota**: Para phpMyAdmin, puedes ingresar con las credenciales de la base de datos que definiste en tu archivo `.env`.

-----

## 🧠 Consejos útiles

  - **Limpiar y cachear la configuración**: Si realizaste cambios en tu archivo `.env`, es buena práctica limpiar y cachear la configuración para que los cambios surtan efecto.
    ```bash
    docker compose exec laravel-app php artisan config:clear
    docker compose exec laravel-app php artisan config:cache
    ```
  - **Ejecutar comandos en el contenedor**: Para ejecutar cualquier comando de Laravel (`artisan`), utiliza la estructura `docker compose exec laravel-app php artisan [comando]`.
  - **Verificar logs**: Si tienes problemas, revisa los logs de los contenedores para identificar errores. Por ejemplo, para ver los logs del contenedor de la aplicación:
    ```bash
    docker compose logs laravel-app
    ```