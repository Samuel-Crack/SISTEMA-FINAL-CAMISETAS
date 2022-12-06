<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once 'Talla.php';
require_once 'Modelos.php';
class Modelo_talla extends Modelo {
    private $_id;
    private $_talla;
    private $_modelos;
    private $_tabla="modelo_talla";
    private $_vista="v_modelo_talla";
    private $_bd;

    public function __construct($id=null, $talla=null, $modelos=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_talla= new Talla($talla);
        $this->_modelos= new Modelos($modelos);
    }
    public function setTalla (Talla $p){
        $this->_talla= $p;
    }
    public function setModelos (Modelos $p){
        $this->_modelos= $p;
    }
    public function getTalla(){
        return $this->_talla;
    }
    public function getModelos(){
        return $this->_modelos;
    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_vista .";";
        return $this->_bd->ejecutar($sql);
    }
    public function leerXTalla($id){
        $sql ="SELECT * FROM ". $this->_tabla
            . " WHERE idtalla=".$id;
        return $this->_bd->ejecutar($sql);
    }
    public function leerXModelos($id){
        $sql ="SELECT * FROM ". $this->_tabla
            . " WHERE idmodelos=".$id;
        return $this->_bd->ejecutar($sql);
    }
     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE idmodelo_talla=".$this->_id;
        
        $datos= $this->_bd->ejecutar($sql);  
        // var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_id = $datos['data'][0]["idmodelo_talla"];
            $this->_talla = new Talla ($datos['data'][0]["idtalla"]);
            $this->_modelos = new Modelos ($datos['data'][0]["idmodelos"]);
        }
    
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idmodelo_talla=".$this->_id;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET idtalla=".$this->_talla->getId() .","
            . " idmodelos=".$this->_modelos->getId() 
            ." WHERE idmodelo_talla=".$this->_id;
         // var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idmodelo_talla, idtalla, idmodelos) VALUES (".
                $this->_id .","
                . $this->_talla->getId().","
                . $this->_modelos->getId()
                .");";
         //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function getId(){
        return $this->_id;
    }

}
