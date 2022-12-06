<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Calidad.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlCalidad
*/
class CtrlCalidad extends Controlador {
    
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

        $obj = new Calidad();
        $resultado = $obj->leer();
        // var_dump($resultado['data']);exit();
        $datos = array(
            'titulo'=>"Calidad",
            'contenido'=>Vista::mostrar('calidad/mostrar.php',$resultado,true),
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
        echo Vista::mostrar('calidad/frmNuevo.php');
    }

    public function guardarNuevo(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        $obj = new Calidad (
                $_POST["id"],
                $_POST["calidad"],
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
            $obj = new Calidad($_REQUEST['id']);
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
            '?ctrl=CtrlCalidad'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['id'])) {
            $obj = new Calidad($_REQUEST['id']);
            $miObj = $obj->leerUno();
            $datos1 = array(
                    'calidad'=>$obj
                );
           echo Vista::mostrar('calidad/frmEditar.php',$datos1);
            }
        
    }
    public function guardarEditar(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        $obj = new Calidad (
                $_POST["id"],    #El id que enviamos
                $_POST["calidad"]
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
   
    public function reporte()
    {
        $obj = new Calidad();
        $resultado = $obj->leer();

        if(isset($_GET['app'])){
            switch ($_GET['app']) {
                case 'excel':
                    $datos=array(
                        'app'=>'excel',
                        'filename'=>'Calidad.xls',
                        'data'=>$resultado['data']
                    );
                    break;
                
                default:
                    $datos=array(
                        'app'=>'word',
                        'filename'=>'Calidad.doc',
                        'data'=>$resultado['data']
                    );
                    break;
            }
            
            Vista::mostrar('calidad/reporteXLSX.php',$datos);
        }
        
    }
}