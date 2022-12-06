<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Detalles_camisetas.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Boletas.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlBoletas
*/
class CtrlBoletas extends Controlador {
    
    public function index($msg=array('titulo'=>'','cuerpo'=>'')){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
            '#'=>'Listado'
        );

        $obj = new Boletas();
        $resultado = $obj->leer();
        // var_dump($resultado['data']);exit();
        $datos = array(
            'titulo'=>"Boletas",
            'contenido'=>Vista::mostrar('boletas/mostrar.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg,
            'data'=>$resultado['data']
        );
        
        $this->mostrarVista('template.php',$datos);
    }
    
    /*public function nuevo(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        echo Vista::mostrar('pais/frmNuevo.php');
    }
    */

    
    public function guardarNuevo() {
        $obj = new Detalles_camisetas();
        
            
        $data=$obj->getProductosCarrito();
        $total=0;
        $datosDetalle=null;
        //Svar_dump($data);exit(); 
        foreach ($data['data'] as $p) {
            $cant = $_SESSION['carrito']->getCantidad($p['iddetalles_camisetas']);
            $img = $_SESSION['carrito']->getImg($p['iddetalles_camisetas']);
            $talla = $_SESSION['carrito']->getTalla($p['iddetalles_camisetas']);
            $precio = $p['precio'];
            $subTotal = $cant * $precio;
            $datosDetalle[]=array(
                'cant'=>$cant,
                'precio'=>$precio,
                'img'=>$img,
                'talla'=>$talla,
                'subtotal'=>$subTotal,
                'iddetalles_camisetas'=>$p['iddetalles_camisetas']
                );
            $total += $cant * $precio;
        }
        
        $obj = new Boletas();
        $obj->nuevo($total, $_SESSION['id'],$datosDetalle);
        
        $this->registrarCompra();
    }

    public function registrarCompra(){
        $obj = new Boletas();
        $data=$obj->getUltimaBoletaCliente($_SESSION['id']);

        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );
        // $datosGraf= $this->getGraficoModelosXMarcas();
        unset($_SESSION['carrito']);
        //var_dump($data);exit(); 
        $datos = array(
            'titulo'=>"Registro de Compra realizada",
            'contenido'=>Vista::mostrar('boletas/registroCompra.php',$data,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>array(
                    'titulo'=>'',
                    'cuerpo'=>''
            ),
            'data'=>null,
        );
        
        $this->mostrarVista('template.php',$datos);

    }

    public function imprimir(){
        $obj = new Boletas();
        $data=$obj->getUltimaBoletaDetalleCliente($_SESSION['id']);
        Vista::mostrar('boletas/boletas.php',$data);
    }
}