# Blog con Laravel y Markdown

Proyecto de ejemplo para el tutorial de Neoguias [**Cómo crear un blog con Laravel y Markdown**](https://www.neoguias.com/tutorial-blog-laravel-markdown/). Los artículos, las categorías y los autores se guardan en archivos. Larablog prepara las rutas y los listados; Laracards genera las portadas.

Laravel sirve las páginas con PHP. No hay exportación de HTML ni hace falta una base de datos.

## Arranca con Docker Compose

Necesitas Docker con Compose y Git. El contenedor PHP incluye Composer, GD, las fuentes y `rsvg-convert`; Node se ejecuta en un contenedor independiente.

```bash
git clone https://github.com/neoguias/tutorial-blog-laravel-markdown.git
cd tutorial-blog-laravel-markdown
cp .env.example .env
docker compose build app
docker compose run --rm app composer install
docker compose run --rm app php artisan key:generate
docker compose run --rm node npm ci
docker compose run --rm node npm run build
docker compose run --rm app php artisan cards:generate
docker compose up -d app
```

Abre <http://localhost:8099>. Para usar otro puerto, añade `APP_PORT=8100` y cambia `APP_URL` en `.env`. La aplicación escucha solo en la interfaz local del equipo.

```bash
docker compose logs -f app
docker compose down
```

## Arranca con herramientas locales

Necesitas PHP 8.4 con las extensiones habituales de Laravel y GD, Composer, Node 24 y `rsvg-convert` (paquete `librsvg2-bin` en Debian/Ubuntu).

```bash
cp .env.example .env
composer install
php artisan key:generate
npm ci
npm run build
php artisan cards:generate
php artisan serve --port=8099
```

## Escribe un artículo

Crea una carpeta en `content/blog/`, con un archivo `es.md`:

```markdown
---
title: Mi primer artículo
slug: mi-primer-articulo
description: Una descripción breve del contenido.
date: 2026-11-01
category: desarrollo
tags: [laravel]
author: edu
draft: false
---

Aquí empieza el texto.
```

Las categorías y los autores se definen en `_categories.yml` y `_authors.yml`. Con `draft: true`, el artículo queda oculto. Una fecha futura programa su publicación.

Las portadas se generan con el título, la categoría, el autor y la fecha. Después de cambiar el contenido ejecuta:

```bash
docker compose run --rm app php artisan larablog:check
docker compose run --rm app php artisan cards:generate
```

El ejemplo incluye tres artículos publicados, un borrador y una entrada programada para 2099. Las imágenes generadas están versionadas; los borradores no generan portada y las entradas programadas sí pueden prepararla antes de publicarse.

## Rutas

| Ruta | Contenido |
| --- | --- |
| `/` | Listado paginado |
| `/{slug}` | Artículo |
| `/categoria/{category}` | Categoría |
| `/etiqueta/{tag}` | Etiqueta |
| `/feed` | RSS |
| `/sitemap.xml` | Sitemap |

## Comprueba el proyecto

```bash
docker compose run --rm app php artisan test --compact
docker compose run --rm app php artisan larablog:check
docker compose run --rm app vendor/bin/pint --format agent
docker compose run --rm node npm run build
```

Las pruebas comprueban las páginas públicas, las categorías, las etiquetas, los metadatos, los borradores, la programación, el RSS y el sitemap. El listado se prueba con una conexión de base de datos inexistente para detectar accesos accidentales.

## Publicación

Compila los recursos y genera las portadas antes de desplegar. Configura `APP_URL` con tu dominio, `APP_ENV=production` y `APP_DEBUG=false`; conserva `CACHE_STORE=file`, `SESSION_DRIVER=array` y `QUEUE_CONNECTION=sync`. El servidor web debe apuntar a `public/` y poder escribir en `storage/` y `bootstrap/cache/`.

Puedes mantener los artículos en Git y desplegar los cambios junto al proyecto. El servidor necesita PHP y las dependencias de Composer. Si llevas las portadas ya generadas, puedes prescindir de `rsvg-convert` en el servidor de producción.

## Licencia

MIT. La fuente DejaVu incluida conserva su licencia en `resources/fonts/LICENSE.txt`.
