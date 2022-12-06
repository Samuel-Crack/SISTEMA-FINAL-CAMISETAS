<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Clientes.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlClientes
*/
class CtrlClientes extends Controlador {
    
    public function index($msg=null){
        $menu= Libreria::getMenu();
        
        $obj = new Clientes();
        $resultado = $obj->leer();
        $msg = ($msg==null)?$this->_getMsg():$msg;
        $datos = array(
            'titulo'=>"Clientes",
            'contenido'=>Vista::mostrar('clientes/mostrar.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$this->_getMigas(),
            'msg'=>$msg
        );
        
        $this->mostrarVista('template.php',$datos);
    }
    public function nuevo(){
        $menu = Libreria::getMenu();
        
        $obj = new Clientes();
        $datos1=array(
            'encabezado'=>'Nueva Clientes',
            'clientes'=>$obj
            );


        $datos = array(
                'titulo'=>'Nueva Clientes',
                'contenido'=>Vista::mostrar('clientes/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$this->_getMigas('nuevo'),
                'msg'=>$this->_getMsg('Nuevo...','Ingrese información para nueva Cliente'),
            );
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Clientes (1,
                $_POST["nombres"],
                $_POST["apellidos"],
                $_POST["dni"],
                $_POST["direccion"],
                $_POST["telefono"],
                $_POST["nacionalidad"],
                $_POST["login"],
                $_POST["clave"],
                2,
                $_POST["email"],
                );
        $respuesta=$obj->nuevo();
        // var_dump($respuesta);exit();
        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $obj = new Clientes($_REQUEST['id']);
            $resultado=$obj->eliminar();
            $this->index($resultado['msg']);
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        $menu = Libreria::getMenu();
        $jsVista = array(
                array(
                'url'=>'recursos/js/jsPais.js'
                )
            );
        if (isset($_REQUEST['id'])) {
            $obj = new Clientes($_REQUEST['id']);
            $miObj = $obj->leerUno();
            if (is_null($miObj['data'])) {
                $this->index($this->_getMsg('Error',
                        'ID Requerido: '.$_REQUEST['id']. ' No Existe')
                    );
            }else{
                $datos1 = array(
                        'clientes'=>$obj
                    );

                $datos = array(
                    'titulo'=>'Editando Clientes: '. $_REQUEST['id'],
                    'contenido'=>Vista::mostrar('clientes/frmEditar.php',$datos1,true),
                    'menu'=>$menu,
                    'migas'=>$this->_getMigas('editar'),
                    'msg'=>$this->_getMsg('Editando...','Iniciando edición para: '.$_REQUEST['id']),
                    'js'=>$jsVista
                );
            }
        }else {
            $datos = array(
                'titulo'=>'Editando Clientes... DESCONOCIDO',
                'contenido'=>'...El Id a Editar es requerido',
                'menu'=>$menu,
                'migas'=>$this->_getMigas('editar'),
                'msg'=>$this->_getMsg('Error','No se encontró al ID requerido')
            );
        }
        
        $this->mostrarVista('template.php',$datos);
    }
    public function guardarEditar(){
        $obj = new Clientes (
                $_POST["id"],
                $_POST["nombres"],
                $_POST["apellidos"],
                $_POST["dni"],
                $_POST["direccion"],
                $_POST["telefono"],
                $_POST["nacionalidad"]
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
    private function _getMigas($operacion=null)     {
        $retorno=null;
        switch ($operacion) {
            case 'nuevo':
                $retorno = array(
                    '?'=>'Inicio',
                    '?ctrl=CtrlClientes'=>'Listado',
                    '#'=>'Nuevo',
                );
                break;
            case 'editar':
                $retorno = array(
                    '?'=>'Inicio',
                    '?ctrl=CtrlClientes'=>'Listado',
                    '#'=>'Editar',
                );
                break;
            
            default:
                $retorno = array(
                    '?'=>'Inicio',
                );
                break;
        }
        return $retorno;
    }
    private function _getMsg($titulo=null,$msg=null){
        return array(
            'titulo'=>$titulo,
            'cuerpo'=>$msg
        );
    }
    public function validar(){
        if (isset($_POST['usuario']) && isset($_POST['clave'])) {
            $obj = new Clientes();
           /* $obj->setLogin($_POST['usuario']);
            $obj->setClave($_POST['clave']);
            */
            $datos=$obj->validar($_POST['usuario'],$_POST['clave']);
            // var_dump($datos);exit();
            if (isset($datos['data']))
                if($datos['data']!=null){
                    $_SESSION['nombre']=$datos['data'][0]['nombres'] .' '. $datos['data'][0]['apellidos'];
                    $_SESSION['direccion']=$datos['data'][0]['direccion'];
                    $_SESSION['telefono']=$datos['data'][0]['telefono'];
                    $_SESSION['nacionalidad']=$datos['data'][0]['nacionalidad'];
                    $_SESSION['email']=$datos['data'][0]['email'];
                    $_SESSION['id']=$datos['data'][0]['idclientes'];
                    $_SESSION['dni']=$datos['data'][0]['dni'];
                    $_SESSION['perfil']=$datos['data'][0]['idperfil'];

                }
        }
        header("Location: ?");
        exit();
    }
    public function cerrarSesion()     {
        session_destroy();
        header("Location: ?");
        exit();
    }
    public function perfil($msg=null)     {
        $menu= Libreria::getMenu();
        
        $obj = new Clientes();
        $resultado = $obj->leer();
        $msg = ($msg==null)?$this->_getMsg():$msg;
        $datos = array(
            'titulo'=>"Perfil",
            'contenido'=>Vista::mostrar('clientes/perfil.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$this->_getMigas(),
            'msg'=>$msg
        );
        
        $this->mostrarVista('template.php',$datos);
    }
}