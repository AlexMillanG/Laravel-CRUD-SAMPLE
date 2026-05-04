# REST API — Laravel

API REST desarrollada con Laravel y MySQL, enfocada en demostrar un dominio sólido del desarrollo backend en PHP bajo un enfoque profesional. El proyecto no se limita a exponer endpoints funcionales, sino que está diseñado siguiendo principios de arquitectura limpia, separación de responsabilidades y buenas prácticas alineadas con stacks modernos como Spring Boot y Express.

Más allá del lenguaje o framework, la intención es evidenciar que los fundamentos del desarrollo backend —modelado de datos, control de flujo, seguridad, persistencia y diseño de APIs— son consistentes. Este proyecto representa una implementación consciente de esos principios dentro del ecosistema de Laravel.

---

## Stack tecnológico

- **PHP / Laravel** — Framework principal para la construcción de la API
- **MySQL** — Sistema de gestión de base de datos relacional
- **Laravel Sanctum** — Autenticación basada en tokens
- **Eloquent ORM** — Manejo de persistencia, relaciones y migraciones

---

## Modelado y relaciones

El diseño de la base de datos sigue una estructura relacional clara, pensada para mantener integridad y escalabilidad:

- `categories` → hasMany → `products`
- `brands` → hasMany → `products`
- `suppliers` → hasMany → `products`
- `products` → belongsTo → `categories`, `brands`, `suppliers`, `users`
- `products` → hasMany → `reviews`
- `reviews` → belongsTo → `products`, `users`
- `roles` ↔ belongsToMany ↔ `users` (pivot: `user_role`)
- `users` → hasMany → `products`, `reviews`

Este modelo permite una correcta normalización de datos y facilita la extensión futura del sistema.

---

## Endpoints

### Autenticación
- `POST /api/register`
- `POST /api/login`
- `POST /api/logout (requiere token)`

### Recursos

#### Products

- `GET /api/products`

- `POST /api/products`

- `GET /api/products/{id}`

- `PUT /api/products/{id}`

- `DELETE /api/products/{id}`



Este mismo esquema CRUD se implementa para:

- `categories`
- `brands`
- `suppliers`
- `reviews`

---

## Instalación

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Objetivo del proyecto

Este proyecto tiene como finalidad demostrar la capacidad de trasladar conocimientos entre diferentes tecnologías backend, manteniendo consistencia en la arquitectura, claridad en la lógica de negocio y buenas prácticas en el desarrollo de APIs.

Se prioriza la legibilidad del código, la organización en capas y el uso adecuado de las herramientas que ofrece Laravel para construir una base sólida y mantenible.
