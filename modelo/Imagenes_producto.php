<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once 'Detalles_camisetas.php';
class Imagenes_producto extends Modelo {
    private $_id;
    private $_url;
    private $_detalles_camisetas;
    private $_nombre;
    private $_tabla="imagenes_producto";
    private $_vista="v_imagenes";

    private $_bd;

    public function __construct($id=null, $url=null,$detalles_camisetas=null, $nombre=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_url= $url;
        $this->_nombre= $nombre;
        $this->_detalles_camisetas= new Detalles_camisetas($detalles_camisetas);
    }
    public function setDetalles_camisetas (Detalles_camisetas $p){
        $this->_detalles_camisetas= $p;
    }
    public function getDetalles_camisetas(){
        return $this->_detalles_camisetas;
    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_vista .";";
        return $this->_bd->ejecutar($sql);
    }
     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE idimagen=".$this->_id;
        
        $datos= $this->_bd->ejecutar($sql);  
        // var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_id = $datos['data'][0]["idimagen"];
            $this->_url = $datos['data'][0]["url"];
            $this->_nombre = $datos['data'][0]["nombre"];
            $this->_detalles_camisetas = new Detalles_camisetas ($datos['data'][0]["iddetalles_camisetas"]);
        }
    
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idimagen=".$this->_id;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET url='".$this->_url."',"
            . " nombre='".$this->_nombre ."',"
            . " idimagen=".$this->_imagen->getId() .","
            ." WHERE idimagen=".$this->_id;
         //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idimagen, url, iddetalles_camisetas, nombre) VALUES (".
            $this->_id .",'"
            . $this->_url ."','"
            . $this->_nombre ."',"
            . $this->_detalles_camisetas->getId().""
            .");";
        // var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function getId(){
        return $this->_id;
    }
    public function getUrl(){
        return $this->_url;
    }
    public function getNombre(){
        return $this->_nombre;
    }
   
}
