<?php
    class MyDBConnection{
        private $server = "127.0.0.1";
        private $user   = "root";
        private $pass   = "";
        private $db     = "galeria";
        private $conexion;

        public function __construct(){
            try{
                $this->conexion = new mysqli($this->server, $this->user, $this->pass, $this->db);
            }
            catch(mysqli_sql_exception $e){
                echo "Error al Conectar con Base de Datos: $e";
            }
        }

        #EJECUTA UN COMANDO SQL [INSERT, DELETE, UPDATE]
        public function ejecuta($sql){
            try{
                mysqli_query($this->conexion, $sql);
            }
            catch(Exception $e){
                return $e;
            }
        }

        #REGRESA RESULTADO DE UNA CONSULTA EN UN ARREGLO
        public function consulta($sql){
            try{
                $resultado = mysqli_query($this->conexion, $sql);
                $numero_registros = $resultado->num_rows;
                
                $answer_array = array();
                for ($i=0; $i < $numero_registros; $i++) { 
                    $resultado->data_seek($i);
                    $fila = $resultado->fetch_assoc();
                    
                    array_push($answer_array, $fila);
                }
                return $answer_array;
            }
            catch(Exception $e){
                return $e;
            }
        }
    }

#CREATE TABLE animals (
#    id MEDIUMINT NOT NULL AUTO_INCREMENT,
#    name CHAR(30) NOT NULL,
#    PRIMARY KEY (id)
#);
#INSERT INTO animals (id,name) VALUES(0,'groundhog');


?>