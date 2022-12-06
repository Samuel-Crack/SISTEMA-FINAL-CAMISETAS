<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once 'Camisetas.php';
require_once 'Modelo_talla.php';
require_once 'Modelo_seleccion.php';
require_once 'Modelo_calidad.php';
class Detalles_camisetas extends Modelo {
    private $_id;
    private $_precio;
    private $_stock;
    private $_camisetas;
    private $_modelo_talla;
    private $_modelo_seleccion;
    private $_modelo_calidad;
    private $_tabla="detalles_camisetas";
    private $_vista="v_detalles_camisetas01";
    private $_bd;

    public function __construct($id=null, $precio=null, $stock=null, $camisetas=null, $modelo_talla=null, $modelo_seleccion=null, $modelo_calidad=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_precio= $precio;
        $this->_stock= $stock;
        $this->_camisetas= new Camisetas($camisetas);
        $this->_modelo_talla= new Modelo_talla($modelo_talla);
        $this->_modelo_seleccion= new Modelo_seleccion($modelo_seleccion);
        $this->_modelo_calidad= new Modelo_calidad($modelo_calidad);
   
    }
    public function setCamisetas (Camisetas $p){
        $this->_camisetas= $p;
    }
    public function setModelo_talla (Modelo_talla $p){
        $this->_modelo_talla= $p;
    }
    public function setModelo_seleccion (Modelo_seleccion $p){
        $this->_modelo_seleccion= $p;
    }
    public function setModelo_calidad (Modelo_calidad $p){
        $this->_modelo_calidad= $p;
    }

    public function getCamisetas(){
        return $this->_camisetas;
    }
    public function getModelo_talla(){
        return $this->_modelo_talla;
    }
    public function getModelo_seleccion(){
        return $this->_modelo_seleccion;
    }
    public function getModelo_calidad(){
        return $this->_modelo_calidad;
    }

    public function leer(){
        $sql ="SELECT * FROM ". $this->_vista .";";
        return $this->_bd->ejecutar($sql);
    }

    public function leerXCamisetas($id){
        $sql ="SELECT * FROM ". $this->_tabla
            . " WHERE idcamisetas=".$id;
        return $this->_bd->ejecutar($sql);
    }
    public function leerXModelo_talla($id){
        $sql ="SELECT * FROM ". $this->_tabla
            . " WHERE idmodelo_talla=".$id;
        return $this->_bd->ejecutar($sql);
    }
    public function leerXModelo_seleccion($id){
        $sql ="SELECT * FROM ". $this->_tabla
            . " WHERE idmodelo_seleccion=".$id;
        return $this->_bd->ejecutar($sql);
    }
    public function leerXModelo_calidad($id){
        $sql ="SELECT * FROM ". $this->_tabla
            . " WHERE idmodelo_calidad=".$id;
        return $this->_bd->ejecutar($sql);
    }

     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE iddetalles_camisetas=".$this->_id;
        
        $datos= $this->_bd->ejecutar($sql);  
        // var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_id = $datos['data'][0]["iddetalles_camisetas"];
            $this->_precio = $datos['data'][0]["precio"];
            $this->_stock = $datos['data'][0]["stock"];
            $this->_camisetas = new Camisetas ($datos['data'][0]["idcamisetas"]);
            $this->_modelo_talla = new Modelo_talla ($datos['data'][0]["idmodelo_talla"]);
            $this->_modelo_seleccion = new Modelo_seleccion ($datos['data'][0]["idmodelo_seleccion"]);
            $this->_modelo_calidad = new Modelo_calidad ($datos['data'][0]["idmodelo_calidad"]);
        }
    
        return $datos; 
    }

    public function getDetalles(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE iddetalles_camisetas=".$this->_id;
        
        $datos= $this->_bd->ejecutar($sql);  

        $sql= "SELECT * FROM imagenes_producto" 
           . " WHERE iddetalles_camisetas=".$this->_id;
        $datos['imagenes']= $this->_bd->ejecutar($sql);
        $sql= "SELECT * FROM talla";
        $datos['tallas']= $this->_bd->ejecutar($sql); 
        return $datos; 
    }




    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE iddetalles_camisetas=".$this->_id;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET precio='".$this->_precio."',"
            . " stock='".$this->_stock ."',"
            . " idcamisetas=".$this->_camisetas->getId() .","
            . " idmodelo_talla=".$this->_modelo_talla->getId() .","
            . " idmodelo_seleccion=".$this->_modelo_seleccion->getId() .","
            . " idmodelo_calidad=".$this->_modelo_calidad->getId()
            ." WHERE iddetalles_camisetas=".$this->_id;
        // var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (iddetalles_camisetas, precio, stock, idcamisetas, idmodelo_talla, idmodelo_seleccion, idmodelo_calidad) VALUES (".
                $this->_id .","
                . $this->_precio .","
                . $this->_stock .","
                . $this->_camisetas->getId().","
                . $this->_modelo_talla->getId().","
                . $this->_modelo_seleccion->getId().","
                . $this->_modelo_calidad->getId()
            .");";
         //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function getId(){
        return $this->_id;
    }
    public function getPrecio(){
        return $this->_precio;
    }
    public function getStock(){
        return $this->_stock;
    }
    # Devolver productos para Carrito
    public function getProductosCarrito()    {
        $prod = null;
        $productos = $_SESSION['carrito']->getProductos();
        // var_dump($productos);exit();
        if (!empty($productos)){
            foreach ($productos as $key => $value) 
                $prod[] =$key;
         
            $misProductos=implode(",", $prod);

            $sql= "SELECT * FROM ". $this->_vista 
                . " WHERE iddetalles_camisetas in(".$misProductos.")";
            // var_dump($sql); exit();
            return $this->_bd->ejecutar($sql); 
        }else{
            return null;
        }
        
    }

}
