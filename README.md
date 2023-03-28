# Daily Trends

<p align="center">
<a href="https://cv.l5enio.com/"><img src="https://img.shields.io/badge/portfolio-web-blueviolet?style=flat&link=https://cv.l5enio.com/" alt="Portfolio Badge"></a>
<a href="https://cv.l5enio.com/"><img src="https://komarev.com/ghpvc/?username=soufian3raki&color=blueviolet" alt="Profile views"></a>
<a href="https://opensource.org/license/mit/"><img src="https://img.shields.io/badge/license-MIT-blueviolet" alt="Portfolio Badge"></a>
</p>

Se pide realizar una pequeña aplicación (DailyTrends) que muestre un feed de noticias. Este feed es un agregador de noticias de diferentes periódicos. DailyTrends es un periódico que une las portadas de los periódicos número uno.

Cuando un usuario abre DailyTrends, se encuentra con las 6 noticias de portada de El Pais y El Mundo del día en el que lo abre, además se pueden añadir noticias a mano desde la aplicación.

## Requisitos Previos

- PHP (versión 8.0.17)
- MySQL (versión 10.4.24-MariaDB)

## Instalación
1. Clona el repositorio en tu equipo
2. Importa la base de datos incluida en la carpeta "DB"
3. Abre el archivo "index.php" en tu navegador web

## Tareas previas
1. Crear un repositorio de GIT (Bitbucket, GitHub o similar) con acceso público
2. Antes de empezar las tareas envíanos por e-mail el enlace del repositorio.
3.Haz los commits que consideres oportunos conforme vayas desarrollando las diferentes tareas (Mínimo un commit por tarea).
## Tareas a realizar
1. Crea un proyecto con una arquitectura de ficheros básica, gasta un framework si lo consideras oportuno.
2. Crea un modelo Feed que tenga los atributos: title, body, image, source y publisher.
3. Crea un controlador que se encargue de gestionar a los servicios CRUD del modelo.
4. Crea un “servicio de lectura de feeds” que extraiga por técnicas de web scraping (no lectura de fuentes RSS) a cada uno de los periódicos en busca de su noticia de portada y que la guarde en un Feed.
5. Crear un controlador que devuelva los feeds de hoy con su título, descripción, imagen, fuente y el periódico donde se ha publicado.
6. Crea una vista listado de Feeds que consuman las noticias.
7. Crea una vista detalle de Feed que se pueda editar y borrar.
8. Crea una vista de creación de Feed.

## Otros detalles
1. Representa en un dibujo la arquitectura de la aplicación.
2. Usa todas las buenas prácticas que conozcas.
3. Haz los tests que consideres necesarios.
4. Usa el motor de estilos que más te guste.

## Tecnologías Utilizadas

- SCSS
- PHP
- MySQL
- JS

## Licencia

- Tipo de licencia MIT
- [Enlace al archivo LICENSE para más información.](https://opensource.org/license/mit/)