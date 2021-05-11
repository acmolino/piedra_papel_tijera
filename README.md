# piedra_papel_tijera
Juego de "Piedra papel o tijera" para jugar en modo VS online. 
Desarrollado con PHP, JavaScript, JQuery y Bootstrap con fines educativos
Falta agregar VS computadora.

## Configuraciones necesarias

**Creación de base de datos**
- archivo ppt_juego.sql

**Configuramos la conexion a la base de datos**
- Archivo : php/config/conexion.php
  
  ```php
    $this->servername = "servidor";
    $this->username = "usuario";
    $this->password = "contraseña";
    $this->dbname = "ppt_juego";
  ```
  
**Configuramos la ruta base**
- Archivo: php/index.php ->Linea 14:

```php
$router->setBasePath('miRuta');
```

**Configuracion de la ruta para pantallas**
- Archivo: www/js/config.js ->Linea 6:
```JavaScipt
var URLBASE = "miRutaBase";
```


## Clases utilizadas
**AltoRouter**
Clase utilizadad pára ruteo PHP - [AltoRouter](https://altorouter.com/).
  
### Bootstrap y Jquery versiones
- Bootstrap 4.0
- JQuery 3.6
  
