<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Detalles_camisetas.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlCarrito
*/
class CtrlCarrito extends Controlador {
    public function agregar() {
        if (!isset($_SESSION['carrito']))
            $_SESSION['carrito'] = new Carrito();

        if (is_object($_SESSION['carrito'])){
            $_SESSION['carrito']->agregar($_POST['id'],1,$_POST['talla'],$_POST['img']);
            
            if(isset($_GET['url'])){
                switch($_GET['url']){
                    case 'detalles':
                        header("Location: ?ctrl=CtrlDetalles_camisetas&accion=verDetalles&id=".$_POST['id']);
                        exit();
                        break;
                    case 'carrito':
                        $this->mostrar();
                        // exit();
                        break;
                    default:
                        header("Location: ?ctrl=CtrlDetalles_camisetas&accion=getCatalogo&id=".$_POST['id']);
                        exit();
                }
            }else{
                header("Location: ?ctrl=CtrlDetalles_camisetas&accion=getCatalogo&id=".$_POST['id']);
                exit();
            }
        }
        else
            echo "Error en objeto";
    }
    public function sacar() {
        if (isset($_SESSION['carrito'])){
            $cant = isset($_GET['cant'])?$_GET['cant']:1;
            $_SESSION['carrito']->sacar($_GET['id'],$cant);
        }
            
        
        $this->mostrar();
    }
    public function mostrar() {
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
            '#'=>'Carrito'
        );
        $data=null;
        if (!isset($_SESSION['carrito'])){
            $miCarrito=Vista::mostrar('carrito/vacio.php','',true);
            
        }else{
            # Recuperar PRODUCTOS según CARRITO
            $obj = new Detalles_camisetas();
            
            $data=$obj->getProductosCarrito();
            if (is_null($data))
                $miCarrito=Vista::mostrar('carrito/vacio.php','',true);
            else
                $miCarrito = Vista::mostrar('carrito/mostrar.php',$data,true);
        }
        // var_dump($miCarrito);exit();
        $datos = array(
            'titulo'=>"Carrito de compras",
            'contenido'=>$miCarrito,
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>array(
                    'titulo'=>'',
                    'cuerpo'=>''
                )
        );
        
        $this->mostrarVista('template.php',$datos);

    }
}