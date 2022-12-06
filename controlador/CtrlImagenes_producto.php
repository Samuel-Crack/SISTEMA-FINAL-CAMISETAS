<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Imagenes_producto.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlImagenes_producto
*/
class CtrlImagenes_producto extends Controlador {
    
    public function index($msg=array('titulo'=>'','cuerpo'=>'')){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );

        $obj = new Imagenes_producto();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Imagenes_producto",
            'contenido'=>Vista::mostrar('imagenes_producto/mostrar.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg
        );
        
        $this->mostrarVista('template.php',$datos);
    }
    public function nuevo(){
        $menu = Libreria::getMenu();
        $msg= array(
            'titulo'=>'Nuevo...',
            'cuerpo'=>'Ingrese información para nueva Imagenes_producto');
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlImagenes_producto'=>'Listado',
            '#'=>'Nuevo',
        );
        $obj = new Imagenes_producto();
        $datos1=array(
            'encabezado'=>'Nueva Imagenes_producto',
            'imagenes_producto'=>$obj
            );

        $datos = array(
                'titulo'=>'Nueva Imagenes_producto',
                'contenido'=>Vista::mostrar('imagenes_producto/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg
            );
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Imagenes_producto (
                $_POST["id"],
                $_POST["url"],
                $_POST["detalles_camisetas"],
                $_POST["nombre"],

                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $obj = new Imagenes_producto($_REQUEST['id']);
            $resultado=$obj->eliminar();
            $this->index($resultado['msg']);
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        $menu = Libreria::getMenu();
        $msg= array(
            'titulo'=>'Editando...',
            'cuerpo'=>'Iniciando edición para: '.$_REQUEST['id']);
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlImagenes_producto'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['id'])) {
            $obj = new Imagenes_producto($_REQUEST['id']);
            $miObj = $obj->leerUno();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['id']. ' No Existe')
                );
            }else{

                $datos1 = array(
                        'imagenes_producto'=>$obj
                    );

                $datos = array(
                    'titulo'=>'Editando Imagenes_producto: '. $_REQUEST['id'],
                    'contenido'=>Vista::mostrar('imagenes_producto/frmEditar.php',$datos1,true),
                    'menu'=>$menu,
                    'migas'=>$migas,
                    'msg'=>$msg
                );
            }
        }else {
            $msg= array(
            'titulo'=>'Error',
            'cuerpo'=>'No se encontró al ID requerido');

            $datos = array(
                'titulo'=>'Editando Imagenes_producto... DESCONOCIDO',
                'contenido'=>'...El Id a Editar es requerido',
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg);
        }
        
        $this->mostrarVista('template.php',$datos);

        
    }
    public function guardarEditar(){
        $obj = new Imagenes_producto (
                $_POST["id"],    #El id que enviamos
                $_POST["url"],
                $_POST["detalles_camisetas"],
                $_POST["nombre"]

                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
}