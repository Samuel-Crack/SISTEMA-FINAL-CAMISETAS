<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Modelo_seleccion.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlModelo_seleccion
*/
class CtrlModelo_seleccion extends Controlador {
    
    public function index($msg=array('titulo'=>'','cuerpo'=>'')){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );

        $obj = new Modelo_seleccion();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Modelo_seleccion",
            'contenido'=>Vista::mostrar('modelo_seleccion/mostrar.php',$resultado,true),
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
            'cuerpo'=>'Ingrese información para nueva Modelo_seleccion');
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlModelo_seleccion'=>'Listado',
            '#'=>'Nuevo',
        );
        $obj = new Modelo_seleccion();
        $datos1=array(
            'encabezado'=>'Nueva Modelo_seleccion',
            'modelo_seleccion'=>$obj
            );

        $datos = array(
                'titulo'=>'Nueva Modelo_seleccion',
                'contenido'=>Vista::mostrar('modelo_seleccion/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg
            );
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Modelo_seleccion (
                $_POST["id"],
                $_POST["descripcion"],
				$_POST["color"],
                $_POST["seleccion"],
                $_POST["modelos"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $obj = new Modelo_seleccion($_REQUEST['id']);
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
            '?ctrl=CtrlModelo_seleccion'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['id'])) {
            $obj = new Modelo_seleccion($_REQUEST['id']);
            $miObj = $obj->leerUno();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['id']. ' No Existe')
                );
            }else{

                $datos1 = array(
                        'modelo_seleccion'=>$obj
                    );

                $datos = array(
                    'titulo'=>'Editando Modelo_seleccion: '. $_REQUEST['id'],
                    'contenido'=>Vista::mostrar('modelo_seleccion/frmEditar.php',$datos1,true),
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
                'titulo'=>'Editando Modelo_seleccion... DESCONOCIDO',
                'contenido'=>'...El Id a Editar es requerido',
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg);
        }
        
        $this->mostrarVista('template.php',$datos);

        
    }
    public function guardarEditar(){
        $obj = new Modelo_seleccion (
                $_POST["id"],    #El id que enviamos
                $_POST["descripcion"],
				$_POST["color"],
                $_POST["seleccion"],
                $_POST["modelo"]
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
    public function getModelo_seleccionSelect(){
        $id = $_GET['id'];
        $obj = new Modelo_seleccion();
        $datos = $obj->leerXSeleccion($id)['data'];
        $datos = $obj->leerXModelos($id)['data'];
        $html = '<option value="0">Seleccionar...</option>';
        foreach ($datos as $d) {
            $html .= '<option value="'.$d['idseleccion'].'">'.$d['seleccion'].'</option>';
            $html .= '<option value="'.$d['idmodelos'].'">'.$d['modelo'].'</option>';
        }
        echo $html;

    }
}