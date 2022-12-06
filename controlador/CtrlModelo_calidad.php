<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Modelo_calidad.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlModelo_calidad
*/
class CtrlModelo_calidad extends Controlador {
    
    public function index($msg=array('titulo'=>'','cuerpo'=>'')){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );

        $obj = new Modelo_calidad();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Modelo_calidad",
            'contenido'=>Vista::mostrar('modelo_calidad/mostrar.php',$resultado,true),
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
            'cuerpo'=>'Ingrese información para nueva Modelo_calidad');
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlModelo_calidad'=>'Listado',
            '#'=>'Nuevo',
        );
        $obj = new Modelo_calidad();
        $datos1=array(
            'encabezado'=>'Nueva Modelo_calidad',
            'modelo_calidad'=>$obj
            );

        $datos = array(
                'titulo'=>'Nueva Modelo_calidad',
                'contenido'=>Vista::mostrar('modelo_calidad/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg
            );
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Modelo_calidad (
                $_POST["id"],
                $_POST["calidad"],
                $_POST["modelos"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $obj = new Modelo_calidad($_REQUEST['id']);
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
            '?ctrl=CtrlModelo_Calidad'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['id'])) {
            $obj = new Modelo_Calidad($_REQUEST['id']);
            $miObj = $obj->leerUno();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['id']. ' No Existe')
                );
            }else{

                $datos1 = array(
                        'modelo_calidad'=>$obj
                    );

                $datos = array(
                    'titulo'=>'Editando Modelo_calidad: '. $_REQUEST['id'],
                    'contenido'=>Vista::mostrar('modelo_calidad/frmEditar.php',$datos1,true),
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
                'titulo'=>'Editando Modelo_calidad... DESCONOCIDO',
                'contenido'=>'...El Id a Editar es requerido',
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg);
        }
        
        $this->mostrarVista('template.php',$datos);

        
    }
    public function guardarEditar(){
        $obj = new Modelo_calidad (
                $_POST["id"],    #El id que enviamos
                $_POST["calidad"],
                $_POST["modelo"]
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
    public function getModelo_calidadSelect(){
        $id = $_GET['id'];
        $obj = new Modelo_calidad();
        $datos = $obj->leerXCalidad($id)['data'];
        $datos = $obj->leerXModelos($id)['data'];
        $html = '<option value="0">Seleccionar...</option>';
        foreach ($datos as $d) {
            $html .= '<option value="'.$d['idcalidad'].'">'.$d['calidad'].'</option>';
            $html .= '<option value="'.$d['idmodelos'].'">'.$d['modelo'].'</option>';
        }
        echo $html;

    }
}