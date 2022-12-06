<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Clientes extends Modelo {
    private $_id;
    private $_nombres;
    private $_apellidos;
    private $_dni;
    private $_direccion;
    private $_telefono;
    private $_nacionalidad;
    private $_login;
    private $_pasword;
    private $_email;
    private $_perfil;

    private $_tabla="clientes";

    private $_bd;

    public function __construct($id=null, $nombres=null, $apellidos=null, 
        $dni=null, $direccion=null, $telefono=null, $nacionalidad=null, 
            $login=null, $pasword=null, $perfil=null,$email=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_nombres = $nombres;
        $this->_apellidos = $apellidos;
        $this->_dni = $dni;
        $this->_direccion = $direccion; 
        $this->_telefono = $telefono; 
        $this->_nacionalidad = $nacionalidad; 
        $this->_login = $login; 
        $this->_pasword = $pasword; 
        $this->_perfil = $perfil; 
        $this->_email = $email; 

    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_tabla .";";
        return $this->_bd->ejecutar($sql);
    }
     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_tabla 
            . " WHERE idclientes=".$this->_id;
        
        $datos= $this->_bd->ejecutar($sql);  
        //var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_id = $datos['data'][0]["idclientes"];
            $this->_nombres = $datos['data'][0]["nombres"];  
            $this->_apellidos = $datos['data'][0]["apellidos"]; 
            $this->_dni = $datos['data'][0]["dni"]; 
            $this->_direccion = $datos['data'][0]["direccion"]; 
            $this->_telefono = $datos['data'][0]["telefono"]; 
            $this->_nacionalidad = $datos['data'][0]["nacionalidad"]; 
            $this->_login = $datos['data'][0]["login"]; 
            $this->_pasword = $datos['data'][0]["pasword"]; 

        }
        
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idclientes=".$this->_id;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET nombres='".$this->_nombres."',apellidos='".$this->_apellidos."',dni='".$this->_dni."',telefono='".$this->_telefono."',nacionalidad='".$this->_nacionalidad."',direccion='".$this->_direccion."'"
            ." WHERE idclientes=".$this->_id;
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." ( nombres, apellidos, dni, direccion, telefono, 
                login, pasword, idperfil, nacionalidad, email) VALUES ('".
           
                 $this->_nombres ."','"
                . $this->_apellidos ."','"
                . $this->_dni ."','"
                . $this->_direccion ."','"
                . $this->_telefono ."','"
                . $this->_login ."','"
                . $this->_pasword ."',"
                . $this->_perfil .",'"
                . $this->_nacionalidad ."','"
                . $this->_email ."'"
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
    public function getNacionalidad(){
        return $this->_nacionalidad;
    }

    public function validar($login,$clave){
        $sql= "SELECT * FROM ". $this->_tabla 
            . " WHERE login='".$login ."' and pasword='".$clave ."'";
        
        return $this->_bd->ejecutar($sql);
    }
}
