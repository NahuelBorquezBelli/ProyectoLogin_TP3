# Proyecto Login

- **Alumno:** Nahuel Borquez Belli
- **Materia:** Analisis de sistema
- **Año de cursada:** 5° 4°

Sistema de login y registro de usuarios.

## Tecnologías
- Front-end: HTML5, CSS3 (responsive, modo oscuro) y JavaScript
- Back-end: PHP 8
- Base de datos: MySQL (puerto 3306)
- Servidor: XAMPP (Apache puertos 80 y 443, localhost 127.0.0.1)

## Instalación
1. Copiar la carpeta `ProyectoLogin_TP3` en `C:\xampp\htdocs\`.
2. Iniciar **Apache** y **MySQL** desde el panel de XAMPP.
3. Abrir `http://localhost/phpmyadmin`, ir a *Importar* y cargar `database/proyecto_login.sql`.
4. Abrir `http://localhost/ProyectoLogin_TP3/`.

## Estructura
```
ProyectoLogin_TP3/
├── config/db.php
├── database/proyecto_login.sql
├── assets/css/style.css
├── assets/js/validacion.js
├── index.php        (login)
├── registro.php     (alta de usuario)
├── bienvenida.php   (usuario logueado)
└── logout.php
```
