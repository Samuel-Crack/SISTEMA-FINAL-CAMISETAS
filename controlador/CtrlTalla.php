<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Talla.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlTalla
*/
class CtrlTalla extends Controlador {
    
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

        $obj = new Talla();
        $resultado = $obj->leer();
        // var_dump($resultado['data']);exit();
        $datos = array(
            'titulo'=>"Talla",
            'contenido'=>Vista::mostrar('talla/mostrar.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg,
            'data'=>$resultado['data']
        );
        
        $this->mostrarVista('template.php',$datos);
    }
    public function nuevo(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        echo Vista::mostrar('talla/frmNuevo.php');
    }

    public function guardarNuevo(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        $obj = new Talla (
                $_POST["id"],
                $_POST["talla"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        if (isset($_REQUEST['id'])) {
            $obj = new Talla($_REQUEST['id']);
            $resultado=$obj->eliminar();
            // var_dump ($resultado);
            $this->index($resultado['msg']);
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function editar(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        #Mostramos el Formulario de Editar
        $datos=null;
        $menu = Libreria::getMenu();
        $msg= array(
            'titulo'=>'Editando...',
            'cuerpo'=>'Iniciando edición de: '.$_REQUEST['id']);
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlTalla'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['id'])) {
            $obj = new Talla($_REQUEST['id']);
            $miObj = $obj->leerUno();
            $datos1 = array(
                    'talla'=>$obj
                );
           echo Vista::mostrar('talla/frmEditar.php',$datos1);
            }
        
    }
    public function guardarEditar(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        $obj = new Talla (
                $_POST["id"],    #El id que enviamos
                $_POST["talla"]
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
   
    public function reporte()
    {
        $obj = new Talla();
        $resultado = $obj->leer();

        if(isset($_GET['app'])){
            switch ($_GET['app']) {
                case 'excel':
                    $datos=array(
                        'app'=>'excel',
                        'filename'=>'Talla.xls',
                        'data'=>$resultado['data']
                    );
                    break;
                
                default:
                    $datos=array(
                        'app'=>'word',
                        'filename'=>'Talla.doc',
                        'data'=>$resultado['data']
                    );
                    break;
            }
            
            Vista::mostrar('talla/reporteXLSX.php',$datos);
        }
        
    }
}