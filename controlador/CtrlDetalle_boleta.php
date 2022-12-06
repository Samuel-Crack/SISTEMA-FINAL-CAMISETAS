<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Detalle_boleta.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlDetalle_boleta
*/
class CtrlDetalle_boleta extends Controlador {
    
    public function index($msg=array('titulo'=>'','cuerpo'=>'')){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );

        $obj = new Detalle_boleta();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Detalle_boleta",
            'contenido'=>Vista::mostrar('detalle_boleta/mostrar.php',$resultado,true),
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
            'cuerpo'=>'Ingrese información para nueva Detalle_boleta');
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlDetalle_boleta'=>'Listado',
            '#'=>'Nuevo',
        );
        $obj = new Detalle_boleta();
        $datos1=array(
            'encabezado'=>'Nueva Detalle_boleta',
            'detalle_boleta'=>$obj
            );

        $datos = array(
                'titulo'=>'Nueva Detalle_boleta',
                'contenido'=>Vista::mostrar('detalle_boleta/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg
            );
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Detalle_boleta (
                $_POST["id"],
                $_POST["cantidad"],
                $_POST["precio_unitario"],
                $_POST["subtotal"],
                $_POST["producto"],
                $_POST["boletas"],
                $_POST["detalles_camisetas"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $obj = new Detalle_boleta($_REQUEST['id']);
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
            '?ctrl=CtrlDetalle_boleta'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['id'])) {
            $obj = new Detalle_boleta($_REQUEST['id']);
            $miObj = $obj->leerUno();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['id']. ' No Existe')
                );
            }else{

                $datos1 = array(
                        'detalle_boleta'=>$obj
                    );

                $datos = array(
                    'titulo'=>'Editando Detalle_boleta: '. $_REQUEST['id'],
                    'contenido'=>Vista::mostrar('detalle_boleta/frmEditar.php',$datos1,true),
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
                'titulo'=>'Editando Detalle_boleta... DESCONOCIDO',
                'contenido'=>'...El Id a Editar es requerido',
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg);
        }
        
        $this->mostrarVista('template.php',$datos);

        
    }
    public function guardarEditar(){
        $obj = new Detalle_boleta (
                $_POST["id"],    #El id que enviamos
                $_POST["cantidad"],
                $_POST["precio_unitario"],
                $_POST["subtotal"],
                $_POST["producto"],
                $_POST["boletas"],
                $_POST["detalles_camisetas"]
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
    public function getDetalle_boletaSelect(){
        $id = $_GET['id'];
        $obj = new Detalle_boleta();
        $datos = $obj->leerXBoletas($id)['data'];
        $datos = $obj->leerXDetalles_camisetas($id)['data'];
        $html = '<option value="0">Seleccionar...</option>';
        foreach ($datos as $d) {
            $html .= '<option value="'.$d['idboletas'].'">'.$d['total'].'</option>';
            $html .= '<option value="'.$d['iddetalles_camisetas'].'">'.$d['stock'].'</option>';
        }
        echo $html;

    }
}