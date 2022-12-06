<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Modelo_talla.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlModelo_talla
*/
class CtrlModelo_talla extends Controlador {
    
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

        $obj = new Modelo_talla();
        $resultado = $obj->leer();
        // var_dump($resultado['data']);exit();
        $datos = array(
            'titulo'=>"Modelo_talla",
            'contenido'=>Vista::mostrar('modelo_talla/mostrar.php',$resultado,true),
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
        echo Vista::mostrar('modelo_talla/frmNuevo.php');
    }

    public function guardarNuevo(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        $obj = new Modelo_talla (
                $_POST["id"],
                $_POST["talla"],
                $_POST["modelos"],
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
            $obj = new Modelo_talla($_REQUEST['id']);
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
            '?ctrl=CtrlModelo_talla'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['id'])) {
            $obj = new Modelo_talla($_REQUEST['id']);
            $miObj = $obj->leerUno();
            $datos1 = array(
                    'modelo_talla'=>$obj
                );
           echo Vista::mostrar('modelo_talla/frmEditar.php',$datos1);
            }
        
    }
    public function guardarEditar(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        $obj = new Modelo_talla (
                $_POST["id"],    #El id que enviamos
                $_POST["talla"],
                $_POST["modelo"]
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
    public function getModelo_tallaSelect(){
        $id = $_GET['id'];
        $obj = new Modelo_talla();
        $datos = $obj->leerXTalla($id)['data'];
        $datos = $obj->leerXModelos($id)['data'];
        $html = '<option value="0">Seleccionar...</option>';
        foreach ($datos as $d) {
            $html .= '<option value="'.$d['idtalla'].'">'.$d['talla'].'</option>';
            $html .= '<option value="'.$d['idmodelos'].'">'.$d['modelo'].'</option>';
        }
        echo $html;

    }
    public function reporte()
    {
        $obj = new Modelo_talla();
        $resultado = $obj->leer();

        if(isset($_GET['app'])){
            switch ($_GET['app']) {
                case 'excel':
                    $datos=array(
                        'app'=>'excel',
                        'filename'=>'Modelo_talla.xls',
                        'data'=>$resultado['data']
                    );
                    break;
                
                default:
                    $datos=array(
                        'app'=>'word',
                        'filename'=>'Modelo_talla.doc',
                        'data'=>$resultado['data']
                    );
                    break;
            }
            
            Vista::mostrar('modelo_talla/reporteXLSX.php',$datos);
        }
        
    }
}