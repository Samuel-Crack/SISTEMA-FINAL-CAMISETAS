<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once 'Calidad.php';
require_once 'Modelos.php';
class Modelo_calidad extends Modelo {
    private $_id;
    private $_calidad;
    private $_modelos;
    private $_tabla="modelo_calidad";
    private $_vista="v_modelo_calidad";
    private $_bd;

    public function __construct($id=null, $calidad=null, $modelos=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_calidad= new Calidad($calidad);
        $this->_modelos= new Modelos($modelos);
    }
    public function setCalidad (Calidad $p){
        $this->_calidad= $p;
    }
    public function setModelos (Modelos $p){
        $this->_modelos= $p;
    }
    public function getCalidad(){
        return $this->_calidad;
    }
    public function getModelos(){
        return $this->_modelos;
    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_vista .";";
        return $this->_bd->ejecutar($sql);
    }
    public function leerXCalidad($id){
        $sql ="SELECT * FROM ". $this->_tabla
            . " WHERE idcalidad=".$id;
        return $this->_bd->ejecutar($sql);
    }
    public function leerXModelos($id){
        $sql ="SELECT * FROM ". $this->_tabla
            . " WHERE idmodelos=".$id;
        return $this->_bd->ejecutar($sql);
    }
     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE idmodelo_calidad=".$this->_id;
        
        $datos= $this->_bd->ejecutar($sql);  
        // var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_id = $datos['data'][0]["idmodelo_calidad"];
            $this->_calidad = new Calidad ($datos['data'][0]["idcalidad"]);
            $this->_modelos = new Modelos ($datos['data'][0]["idmodelos"]);
        }
    
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idmodelo_calidad=".$this->_id;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET idcalidad=".$this->_calidad->getId() .","
            . " idmodelos=".$this->_modelos->getId() 
            ." WHERE idmodelo_calidad=".$this->_id;
         // var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idmodelo_calidad, idcalidad, idmodelos) VALUES (".
                $this->_id .","
                . $this->_calidad->getId().","
                . $this->_modelos->getId()
                .");";
         //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function getId(){
        return $this->_id;
    }

}
