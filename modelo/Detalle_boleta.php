<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once 'Boletas.php';
require_once 'Detalles_camisetas.php';
class Detalle_boleta extends Modelo {
    private $_id;
    private $_cantidad;
    private $_precio_unitario;
    private $_subtotal;
    private $_producto;
    private $_boletas;
    private $_detalles_camisetas;
    private $_tabla="detalle_boleta";
    private $_vista="v_detalle_boleta";
    private $_bd;

    public function __construct($id=null, $cantidad=null, $precio_unitario=null, $subtotal=null, $producto=null, $boletas=null, $detalles_camisetas=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_cantidad= $cantidad;
        $this->_precio_unitario= $precio_unitario;
        $this->_subtotal= $subtotal;
        $this->_producto= $producto;
        $this->_boletas= new Boletas($boletas);
        $this->_detalles_camisetas= new Detalles_camisetas($detalles_camisetas);
    }
    public function setBoletas (Boletas $p){
        $this->_boletas= $p;
    }
    public function setDetalles_camisetas (Detalles_camisetas $p){
        $this->_detalles_camisetas= $p;
    }

    public function getBoletas(){
        return $this->_boletas;
    }
    public function getDetalles_camisetas(){
        return $this->_detalles_camisetas;
    }

    public function leer(){
        $sql ="SELECT * FROM ". $this->_vista .";";
        return $this->_bd->ejecutar($sql);
    }

    public function leerXBoleta($id){
        $sql ="SELECT * FROM ". $this->_tabla
            . " WHERE idboleta=".$id;
        return $this->_bd->ejecutar($sql);
    }
    public function leerXDetalles_camisetas($id){
        $sql ="SELECT * FROM ". $this->_tabla
            . " WHERE iddetalles_camisetas=".$id;
        return $this->_bd->ejecutar($sql);
    }

     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE iddetalle_boleta=".$this->_id;
        
        $datos= $this->_bd->ejecutar($sql);  
        // var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_id = $datos['data'][0]["iddetalle_boleta"];
            $this->_cantidad = $datos['data'][0]["cantidad"];
            $this->_precio_unitario = $datos['data'][0]["precio_unitario"];
            $this->_subtotal = $datos['data'][0]["subtotal"];
            $this->_producto = $datos['data'][0]["producto"];
            $this->_boletas = new Boletas ($datos['data'][0]["idboletas"]);
            $this->_detalles_camisetas = new Detalles_camisetas ($datos['data'][0]["iddetalles_camisetas"]);
        }
    
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE iddetalle_boleta=".$this->_id;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET cantidad='".$this->_cantidad."',"
            . " precio_unitario='".$this->_precio_unitario ."',"
            . " subtotal='".$this->_subtotal ."',"
            . " producto='".$this->_producto ."',"
            . " idboletas=".$this->_boletas->getId() .","
            . " iddetalles_camisetas=".$this->_detalles_camisetas->getId() 
            ." WHERE iddetalle_boleta=".$this->_id;
         //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (iddetalle_boleta, cantidad, precio_unitario, subtotal, producto, idboletas, iddetalles_camisetas) VALUES (".
                $this->_id .",'"
                . $this->_cantidad ."','"
                . $this->_precio_unitario ."','"
                . $this->_subtotal ."','"
                . $this->_producto ."',"
                . $this->_boletas->getId().","
                . $this->_detalles_camisetas->getId()
            .");";
         //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }



    public function getId(){
        return $this->_id;
    }
    public function getCantidad(){
        return $this->_cantidad;
    }
    public function getPrecio_unitario(){
        return $this->_precio_unitario;
    }
    public function getSubtotal(){
        return $this->_subtotal;
    }
    public function getProducto(){
        return $this->_producto;
    }

}
