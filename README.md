# Games

Este es el código de mi proyecto **"juegos"**, donde podrás ver hasta la última línea del código, también podrás descargarlo y usarlo libremente, siempre mencionándome como "Alberto Sánchez Torreblanca".

## Prueba online

Puedes probarlo en vivo en mi sitio WEB **[https://albertost.sytes.net/apps/games/](https://albertost.sytes.net/apps/games/)**.

## Requisitos

### Requisitos Mínimos

- Apache v2.4.53
- PHP v8.1.1
- MySQL v8.0.25 o MariaDB v10.7.6

### Requisitos Recomendados

- Apache v2.4.54
- PHP v8.1.11
- MySQL v8.0.30 o MariaDB v10.9.3

## Instalación

1. Descargar el software desde esta misma página y moverlo a su servidor Apache.
2. Para la creación de la base de datos dispone de un **Script SQL** en **"assets/sql/database.sql"**, este creará la base de datos y las tablas necesarias para funcionar correctamente.

Con estos dos sencillos pasos ya está instalado.

## Configuración

La única configuración que hay que hacer en el propio código es establecer la conexión a la base de datos, que se realiza en el archivo ubicado en **"src/classes/DB.php"**.

Tranquilo, si no eres programador está comentado claramente el lugar donde rellenarlo manualmente con la configuración de su base de datos.

También en el archivo de configuración de PHP (**php.ini**) hay que modificar estas configuraciones para el correcto funcionamiento de la subida de archivos de la administración.

```ini
;;;;;;;;;;;;;;;;;;;;;;
; Dynamic Extensions ;
;;;;;;;;;;;;;;;;;;;;;;

;extension=bz2
extension=curl
;extension=ffi
;extension=ftp
extension=fileinfo
extension=gd
;extension=gettext
;extension=gmp
extension=intl
;extension=imap
;extension=ldap
extension=mbstring
;extension=exif      ; Must be after mbstring as it depends on it
extension=mysqli
;extension=oci8_12c  ; Use with Oracle Database 12c Instant Client
;extension=oci8_19  ; Use with Oracle Database 19 Instant Client
;extension=odbc
extension=openssl
;extension=pdo_firebird
extension=pdo_mysql
;extension=pdo_oci
;extension=pdo_odbc
;extension=pdo_pgsql
;extension=pdo_sqlite
;extension=pgsql
;extension=shmop

;;;;;;;;;;;;;;;;
; File Uploads ;
;;;;;;;;;;;;;;;;

; Whether to allow HTTP file uploads.
; https://php.net/file-uploads
file_uploads = On

; Temporary directory for HTTP uploaded files (will use system default if not
; specified).
; https://php.net/upload-tmp-dir
upload_tmp_dir = C:/php/temp/

; Maximum allowed size for uploaded files.
; https://php.net/upload-max-filesize
upload_max_filesize = 2M

; Maximum number of files that can be uploaded via a single request
max_file_uploads = 2
```

## Aclaraciones

Este software funciona correctamente y ha sido probado por mí mismo, si no funciona en su servidor o equipo no me hago responsable de cualquier fallo en la configuración y uso del mismo.