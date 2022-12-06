<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once MOD . DIRECTORY_SEPARATOR . "Clientes.php";
require_once MOD . DIRECTORY_SEPARATOR . "Detalle_boleta.php";

class Boletas extends Modelo {
    private $_id;
    private $_numero;
    private $_fecha;
    private $_total;
    private $_clientes;
    private $_vendedor;
    private $_detalles;


    private $_tabla="boletas";
    private $_bd;

    public function __construct($id=null, $numero=null ,$fecha=null ,$total=0){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_numero= $numero;
        $this->_fecha= $fecha;
        $this->_total= $total;

    }
    public function setClientes(Clientes $c) {
        $this->_clientes=$c;
    }
    public function addDetalle(Detalle $d){
        $this->_detalles[]=$d;
    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_tabla .";";
        return $this->_bd->ejecutar($sql);
    }
    public function leerUno(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE idboletas=".$this->_id;

        $datos= $this->_bd->ejecutar($sql);  
        //var_dump($datos);exit();
        if (is_array($datos['data'])){
          $this->_id = $datos['data'][0]["idboletas"];
            $this->_numero = $datos['data'][0]["numero"];
            $this->_fecha = $datos['data'][0]["fecha"];
            $this->_total = $datos['data'][0]["total"];
        }
        
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idboletas=".$this->_id;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
   
            . " SET fecha='".$this->_fecha."',"
            . " numero='".$this->_numero ."',"
            . " total='".$this->_total ."',"
            . " idclientes=".$this->_clientes->getId() .","
            . " idvendedor=".$this->_vendedor->getId() 
            ." WHERE idboletas=".$this->_id;
         // var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo($total=0,$idClientes=1,$detalles=null){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (total, idclientes, idvendedor) VALUES (".
                $total*1.18 .",". $idClientes.",". 1
            .");";
              
        $this->_bd->ejecutar($sql);

        foreach ($detalles as $d) {
            $sql = "INSERT INTO detalle_boleta" 
            ." (cantidad, precio_unitario,subtotal,iddetalles_camisetas,producto) VALUES (".
                $d['cant'] .",". $d['precio'].",". $d['subtotal'].",". $d['iddetalles_camisetas']
                .",'Talla: ". $d['talla']." - Modelo de imagen: ".$d['img']."'"
            .");";
           //var_dump($sql);exit(); 
        $this->_bd->ejecutar($sql);
        }

    }
    public function getId(){
        return $this->_id;
    }
    public function getNombre(){
        return $this->_nombre;
    }
    public function getUltimaBoletaDetalleCliente($id)  {
        $sql = "SELECT * FROM `v_boletas` WHERE idboletas=idBoletaCliente(".$id.")";
        return $this->_bd->ejecutar($sql);
    }
    public function getUltimaBoletaCliente($id)  {
        $sql = "SELECT * FROM ". $this->_tabla." WHERE idboletas=idBoletaCliente(".$id.")";
        return $this->_bd->ejecutar($sql);
    }
}
