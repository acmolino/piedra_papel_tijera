# piedra_papel_tijera
Juego de "Piedra papel o tijera" para jugar en modo VS online. 
Desarrollado con PHP, JavaScript, JQuery y Bootstrap con fines educativos
Falta agregar VS computadora.

## Configuraciones necesarias

**Creación de base de datos**
- archivo ppt_juego.sql

**php/config/conexion.php**
 - Configuramos la conexion a la base de datos
  ```php
    $this->servername = "servidor";
    $this->username = "usuario";
    $this->password = "contraseña";
    $this->dbname = "ppt_juego";
  ```
  
**php/index.php**
- Configuramos la ruta base-Linea 14:
```php
$router->setBasePath('miRuta');
```

**www/js/config.js**
- Configuracion de la ruta para pantallas-Linea 6:
```JavaScipt
var URLBASE = "miRutaBase";
```


## Clases utilizadas
**AltoRouter**
Clase utilizadad pára ruteo PHP - [AltoRouter](https://altorouter.com/).
  
### Bootstrap y Jquery versiones
- Bootstrap 4.0
- JQuery 3.6
  
