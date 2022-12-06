<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once 'Marca.php';
class Modelos extends Modelo {
    private $_id;
    private $_modelo;
    private $_marca;
    private $_tabla="modelos";
    private $_vista="v_modelos";
    private $_bd;

    public function __construct($id=null, $modelo=null,$marca=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_modelo= $modelo;
        $this->_marca= new Marca($marca);
    }
    public function setMarca (Marca $p){
        $this->_marca= $p;
    }
    public function getMarca(){
        return $this->_marca;
    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_vista .";";
        return $this->_bd->ejecutar($sql);
    }
     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE idmodelos=".$this->_id;
        
        $datos= $this->_bd->ejecutar($sql);  
        // var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_id = $datos['data'][0]["idmodelos"];
            $this->_modelo = $datos['data'][0]["modelo"];
            $this->_marca = new Marca ($datos['data'][0]["idmarca"]);
        }
    
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idmodelos=".$this->_id;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET modelo='".$this->_modelo."',"
            . " idmarca='".$this->_marca->getId() ."'"
            ." WHERE idmodelos=".$this->_id;
         //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idmodelos, modelo, idmarca) VALUES (".
                $this->_id .",'". $this->_modelo ."',"
                . $this->_marca->getId()
            .");";
        // var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function getId(){
        return $this->_id;
    }
    public function getModelo(){
        return $this->_modelo;
    }
}
