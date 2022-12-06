<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Detalles_camisetas.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlDetalles_camisetas
*/
class CtrlDetalles_camisetas extends Controlador {
    
    public function index($msg=array('titulo'=>'','cuerpo'=>'')){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );

        $obj = new Detalles_camisetas();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Detalles_camisetas",
            'contenido'=>Vista::mostrar('detalles_camisetas/mostrar.php',$resultado,true),
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
            'cuerpo'=>'Ingrese información para nuevo Detalles_camisetas');
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlDetalles_camisetas'=>'Listado',
            '#'=>'Nuevo',
        );
        $obj = new Detalles_camisetas();
        $datos1=array(
            'encabezado'=>'Nuevo Detalles_camisetas',
            'detalles_camisetas'=>$obj
            );

        $datos = array(
                'titulo'=>'Nueva Detalles_camisetas',
                'contenido'=>Vista::mostrar('detalles_camisetas/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg
            );
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Detalles_camisetas (
                $_POST["id"],
                $_POST["precio"],
                $_POST["stock"],
                $_POST["camisetas"],
                $_POST["modelo_talla"],
                $_POST["modelo_seleccion"],
                $_POST["modelo_calidad"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $obj = new Detalles_camisetas($_REQUEST['id']);
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
            '?ctrl=CtrlDetalles_camisetas'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['id'])) {
            $obj = new Detalles_camisetas($_REQUEST['id']);
            $miObj = $obj->leerUno();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['id']. ' No Existe')
                );
            }else{

                $datos1 = array(
                        'detalles_camisetas'=>$obj
                    );

                $datos = array(
                    'titulo'=>'Editando Detalles_camisetas: '. $_REQUEST['id'],
                    'contenido'=>Vista::mostrar('detalles_camisetas/frmEditar.php',$datos1,true),
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
                'titulo'=>'Editando Detalles_camisetas... DESCONOCIDO',
                'contenido'=>'...El Id a Editar es requerido',
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg);
        }
        
        $this->mostrarVista('template.php',$datos);

        
    }
    public function guardarEditar(){
        $obj = new Detalles_camisetas (
                $_POST["id"],    #El id que enviamos
                $_POST["precio"],
                $_POST["stock"],
                $_POST["camisetas"],
                $_POST["modelo_talla"],
                $_POST["modelo_seleccion"],
                $_POST["modelo_calidad"]
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
    public function getDetalles_camisetasesSelect(){
        $id = $_GET['id'];
        $obj = new Detalles_camisetas();
        $datos = $obj->leerXCamisetas($id)['data'];
        $datos = $obj->leerXModelo_talla($id)['data'];
        $datos = $obj->leerXModelo_seleccion($id)['data'];
        $datos = $obj->leerXModelo_calidad($id)['data'];
        $html = '<option value="0">Seleccionar...</option>';
        foreach ($datos as $d) {
            $html .= '<option value="'.$d['idcamisetas'].'">'.$d['descripcion'].'</option>';
            $html .= '<option value="'.$d['idmodelo_talla'].'">'.$d['talla'].'</option>';
            $html .= '<option value="'.$d['idmodelo_seleccion'].'">'.$d['seleccion'].'</option>';
            $html .= '<option value="'.$d['idmodelo_calidad'].'">'.$d['calidad'].'</option>';
        }
        echo $html;

    }
    public function getCatalogo(){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
            '#'=>'Catálogo',
        );

        $obj = new Detalles_camisetas();
        $resultado = $obj->leer();
        
        $msg=(!isset($_GET['id']))?array('titulo'=>'','cuerpo'=>''):array('titulo'=>'Nuevo elemento','cuerpo'=>'Se agregó un elemento al Carrito');
        $datos = array(
            'titulo'=>"Catálogo",
            'contenido'=>Vista::mostrar('detalles_camisetas/catalogo.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg
        );
        
        $this->mostrarVista('template.php',$datos);
    }
    public function verDetalles(){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlDetalles_camisetas&accion=getCatalogo'=>'Catálogo',
            '#'=>'Detalles',
        );
        $id = $_REQUEST['id'];
        $jsVista = array(
                array(
                'url'=>'recursos/js/jsImagenes.js'
                )
            );

        $obj = new Detalles_camisetas($id);
        $resultado = $obj->getDetalles();

        $msg=array('titulo'=>'','cuerpo'=>'');
        $datos = array(
            'titulo'=>"Detalles",
            'contenido'=>Vista::mostrar('detalles_camisetas/detalles.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg,
            'js'=>$jsVista
        );
        
        $this->mostrarVista('template.php',$datos);
    }
}