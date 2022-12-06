<?php
session_start();

abstract class Libreria {
    static function getMenu($perfil=0){  # Generamos el MENU de opciones
        $menuAdmin = array(
            array(
                'icono'=>'users',
                'enlace'=>'CtrlClientes',
                'texto'=>'Clientes'
            ),
            array(
                'icono'=>'user',
                'enlace'=>'CtrlVendedor',
                'texto'=>'Vendedor'
            ),
            array(
                'icono'=>'clipboard',
                'enlace'=>'CtrlBoletas',
                'texto'=>'Boletas'
            ),
            array(
                'icono'=>'file',
                'enlace'=>'CtrlDetalle_boleta',
                'texto'=>'Detalle Boleta'
            ),
            array(
                'icono'=>'tshirt',
                'enlace'=>'CtrlTalla',
                'texto'=>'Talla'
            ),
            array(
                'icono'=>'tshirt',
                'enlace'=>'CtrlModelo_talla',
                'texto'=>'Modelo_talla'
            ),
            array(
                'icono'=>'dragon',
                'enlace'=>'CtrlCalidad',
                'texto'=>'Calidad'
            ),
            array(
                'icono'=>'dragon',
                'enlace'=>'CtrlModelo_calidad',
                'texto'=>'Modelo calidad'
            ),
            array(
                'icono'=>'globe',
                'enlace'=>'CtrlSeleccion',
                'texto'=>'Seleccion'
            ),
            array(
                'icono'=>'globe-europe',
                'enlace'=>'CtrlModelo_seleccion',
                'texto'=>'Modelo Seleccion'
            ),

            array(
                'icono'=>'check-circle',
                'enlace'=>'CtrlModelos',
                'texto'=>'Modelos'
            ),
            array(
                'icono'=>'apple-alt',
                'enlace'=>'CtrlMarca',
                'texto'=>'Marca'
            ),
            array(
                'icono'=>'tshirt',
                'enlace'=>'CtrlCamisetas',
                'texto'=>'Camisetas'
            ),
            array(
                'icono'=>'tshirt',
                'enlace'=>'CtrlDetalles_camisetas',
                'texto'=>'Detalles camisetas'
            ),

            array(
                'icono'=>'tshirt',
                'enlace'=>'CtrlImagenes_producto',
                'texto'=>'Imagenes_producto'
            ),
        );

        $menuVendedor = array(
           
            array(
                'icono'=>'tshirt',
                'enlace'=>'CtrlDetalles_camisetas',
                'texto'=>'Detalles camisetas'
            ),
        );


        switch ($perfil) {
            case '1':   # Admin
                $menu = $menuAdmin;
                break;
            case '2':   # empleado
                $menu = $menuCliente;
                break;
            case '3':   # vendedor
                $menu = $menuVendedor;
                break;
            default:
                $menu = $menuAdmin;
                break;
        }
        return $menu;
    }
    static function cssGlobales(){
        return array(
                array(
                    'nombre'=>'Google Font: Source Sans Pro',
                    'url'=>'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'
                ),
                
                array(
                    'nombre'=>'Font Awesome',
                    'url'=>'plugins/fontawesome-free/css/all.min.css'
                ),
                array(
                    'nombre'=>'Ionicons',
                    'url'=>'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'
                ),
                array(
                    'nombre'=>'Tempusdominus Bootstrap 4',
                    'url'=>'recursos/css/bootstrap.min.css'
                    # 'url'=>'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'
                ),
                array(
                    'nombre'=>'iCheck',
                    'url'=>'plugins/icheck-bootstrap/icheck-bootstrap.min.css'
                ),
                array(
                    'nombre'=>'JQVMap',
                    'url'=>'plugins/jqvmap/jqvmap.min.css'
                ),
                array(
                    'nombre'=>'Theme style',
                    'url'=>'dist/css/adminlte.min.css'
                ),
                array(
                    'nombre'=>'overlayScrollbars',
                    'url'=>'plugins/overlayScrollbars/css/OverlayScrollbars.min.css'
                ),
                array(
                    'nombre'=>'Daterange picker',
                    'url'=>'plugins/daterangepicker/daterangepicker.css'
                ),
                array(
                    'nombre'=>'summernote',
                    'url'=>'plugins/summernote/summernote-bs4.min.css'
                ),
                array(
                    'nombre'=>'jsToast',
                    'url'=>'recursos/css/jquery/jquery-toast.css'
                )
            );
    }
    
    static function jsGlobales(){
        return array(
            array(
                'url'=>'plugins/jquery/jquery.min.js'
            ),
            array(
                'url'=>'plugins/jquery-ui/jquery-ui.min.js'
            ),
            array(
                'url'=>'plugins/bootstrap/js/bootstrap.bundle.min.js'
            ),
            array(
                'url'=>'dist/js/adminlte.js'
            ),
            array(
                'url'=>'dist/js/demo.js'
            ),
            array(
                'url'=>'dist/js/pages/dashboard3.js'
            ),
            array(
                'url'=>'recursos/js/jq-toast.min.js'
            ),
            array(
                'url'=>'plugins/chart.js/Chart.min.js'
            ),
            
            array(
                'url'=>'recursos/js/jspdf.debug.js'
            ),
            
            array(
                'url'=>'recursos/js/jspdf.plugin.autotable3.1.1.min.js'
            ), 
        );
    }

}
