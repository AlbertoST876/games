# Games

Este es el código de mi proyecto **"juegos"**, donde podrás ver hasta la última línea del código, también podrás descargarlo y usarlo libremente, siempre mencionándome como "Alberto Sánchez Torreblanca".

## Prueba online

Puedes probarlo en vivo en mi sitio WEB **[https://albertost.sytes.net/apps/games/](https://albertost.sytes.net/apps/games/)**.

## Requisitos

- Apache - 2.4.53
- PHP - 8.1.6
- MySQL - 8.0.28 o MariaDB - 10.6.7

## Instalación

1. Descargar el software desde esta misma página y moverlo a su servidor Apache.
2. Para la creación de la base de datos dispone de un **Script SQL** en **"resources/database.sql"**, este creará la base de datos y las tablas necesarias para funcionar correctamente.

Con estos dos sencillos pasos ya está instalado.

## Configuración

La única configuración que hay que hacer en el propio código es establecer la conexión a la base de datos, que se realiza en el archivo ubicado en **"modules/db/db.php"**.

Tranquilo, si no eres programador está comentado claramente el lugar donde rellenarlo manualmente con la configuración de su base de datos.

## Aclaraciones

Este software funciona correctamente y ha sido probado por mí mismo, si no funciona en su servidor o equipo no me hago responsable de cualquier fallo en la configuración y uso del mismo.