# 🚀 Laravel + Docker

Este proyecto es una instalación de Laravel totalmente dockerizada. No necesitas tener PHP, Composer o MySQL instalados en tu máquina local. Todo corre dentro de contenedores Docker.

---

## 📦 Servicios incluidos

- **PHP 8.2** (FPM)
- **Nginx** (como servidor web)
- **MySQL 8.0**
- **Composer** (para instalar Laravel y dependencias)

---

## 🧰 Requisitos

- Docker
- Docker Compose v2+

---

## ▶️ Primeros pasos

### 1. Clonar el repositorio o posicionarte en tu carpeta

```bash
cd vet
```
---
### 2. Crea el archivo .end dentrod de la carpeta mysql

```bash
MYSQL_DATABASE=
MYSQL_USER=
MYSQL_PASSWORD=
MYSQL_ROOT_PASSWORD=
```
---
### 3. Ejecuta Docker compose y otros comandos
```bash
docker compose up -d
docker compose run --rm composer install
docker compose run --rm artisan key:generate
docker compose run --rm artisan migrate

```
---
### 4. Tareas progrmadas
```bash
docker compose run --rm artisan sanctum:prune-expired --hours=24
```