<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Vendedor extends Modelo {
    private $_id;
    private $_nombres;
    private $_apellidos;
    private $_dni;
    private $_direccion;
    private $_telefono;
    private $_tabla="vendedor";
    private $_bd;

    public function __construct($id=null, $nombres=null, $apellidos=null, $dni=null, $direccion=null, $telefono=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_nombres = $nombres;
        $this->_apellidos = $apellidos;
        $this->_dni = $dni;
        $this->_direccion = $direccion; 
        $this->_telefono = $telefono; 
    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_tabla .";";
        return $this->_bd->ejecutar($sql);
    }
     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_tabla 
            . " WHERE idvendedor=".$this->_id;
        
        $datos= $this->_bd->ejecutar($sql);  
        //var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_id = $datos['data'][0]["idvendedor"];
            $this->_nombres = $datos['data'][0]["nombres"];  
            $this->_apellidos = $datos['data'][0]["apellidos"]; 
            $this->_dni = $datos['data'][0]["dni"]; 
            $this->_direccion = $datos['data'][0]["direccion"]; 
            $this->_telefono = $datos['data'][0]["telefono"]; 
 
        }
        
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idvendedor=".$this->_id;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
        . " SET nombres='".$this->_nombres."',apellidos='".$this->_apellidos."',dni='".$this->_dni."',telefono='".$this->_telefono."',direccion='".$this->_direccion."'"
        ." WHERE idvendedor=".$this->_id;
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idvendedor, nombres, apellidos, dni, direccion, telefono) VALUES (".
            $this->_id .",'"
            . $this->_nombres ."','"
            . $this->_apellidos ."','"
            . $this->_dni ."','"
            . $this->_direccion ."','"
            . $this->_telefono ."'"

            .");";
       //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function getId(){
        return $this->_id;
    }
    public function getNombres(){
        return $this->_nombres;
    }
    public function getApellidos(){
        return $this->_apellidos;
    }
    public function getDni(){
        return $this->_dni;
    }
    public function getDireccion(){
        return $this->_direccion;
    }
    public function getTelefono(){
        return $this->_telefono;
    }
}
