<?php

class conexionBD{

  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $db;

  /*LOCAL*/
  public function __construct(){
    $this->servername = "localhost";
    $this->username = "root";
    $this->password = "1234";
    $this->dbname = "ej_personas";

    try {
      $this->db = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname.';charset=utf8', $this->username, $this->password);
      //echo "Estamos conectados";
    } catch (PDOException $e) {
            die($e->getMessage());

        }
    //Atributos de la base
    $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function conectar(){
    return $this->db;
  }

}


?>