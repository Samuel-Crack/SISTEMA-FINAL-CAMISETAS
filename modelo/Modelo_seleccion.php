<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once 'Seleccion.php';
require_once 'Modelos.php';
class Modelo_seleccion extends Modelo {
    private $_id;
    private $_descripcion;
    private $_color;
    private $_seleccion;
    private $_modelos;
    private $_tabla="modelo_seleccion";
    private $_vista="v_modelo_seleccion";
    private $_bd;

    public function __construct($id=null, $descripcion=null, $color=null, $seleccion=null, $modelos=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_descripcion= $descripcion;
        $this->_color= $color;
        $this->_seleccion= new Seleccion($seleccion);
        $this->_modelos= new Modelos($modelos);
    }
    public function setSeleccion (Seleccion $p){
        $this->_seleccion= $p;
    }
    public function setModelos (Modelos $p){
        $this->_modelos= $p;
    }
    public function getSeleccion(){
        return $this->_seleccion;
    }
    public function getModelos(){
        return $this->_modelos;
    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_vista .";";
        return $this->_bd->ejecutar($sql);
    }
    public function leerXSeleccion($id){
        $sql ="SELECT * FROM ". $this->_tabla
            . " WHERE idseleccion=".$id;
        return $this->_bd->ejecutar($sql);
    }
    public function leerXModelos($id){
        $sql ="SELECT * FROM ". $this->_tabla
            . " WHERE idmodelos=".$id;
        return $this->_bd->ejecutar($sql);
    }


     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE idmodelo_seleccion=".$this->_id;
        
        $datos= $this->_bd->ejecutar($sql);  
        // var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_id = $datos['data'][0]["idmodelo_seleccion"];
            $this->_descripcion = $datos['data'][0]["descripcion"];
            $this->_color = $datos['data'][0]["color"];
            $this->_seleccion = new Seleccion ($datos['data'][0]["seleccion"]);
            $this->_modelos = new Modelos ($datos['data'][0]["idmodelos"]);
        }
    
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idmodelo_seleccion=".$this->_id;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET descripcion='".$this->_descripcion."',"
            . " color='".$this->_color ."',"
            . " idmodelos=".$this->_modelos->getId() .","
            . " idseleccion=".$this->_seleccion->getId()
            ." WHERE idmodelo_seleccion=".$this->_id;
        // var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idmodelo_seleccion, descripcion, color, idseleccion, idmodelos) VALUES (".
                $this->_id .",'"
                . $this->_descripcion ."','"
                . $this->_color ."',"
                . $this->_seleccion->getId().","
                . $this->_modelos->getId()
            .");";
        //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function getId(){
        return $this->_id;
    }
    public function getDescripcion(){
        return $this->_descripcion;
    }
    public function getColor(){
        return $this->_color;
    }
}
