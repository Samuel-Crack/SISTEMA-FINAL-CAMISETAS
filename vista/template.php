<?php 
 $dataCSS =
      array ('cssGbl'=> Libreria::cssGlobales()
    );
    $dataJS = 
      array('jsGbl'=>Libreria::jsGlobales(),
          'msg'=>$datos['msg'],
        'data'=>isset($data)?$data:''
      );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$titulo?></title>
    <?php echo Vista::mostrar('./plantilla/css.php',$dataCSS,true); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  
    <?php 
      $sesion=isset($_SESSION['perfil'])?$_SESSION['perfil']:0;
      switch ($sesion) {
        case '1':
          echo Vista::mostrar('./plantilla/nav.php',$datos,true);
          echo Vista::mostrar('./plantilla/aside.php',$datos,true); 
          break;
        case '2':
          echo Vista::mostrar('./plantilla/nav1.php',$datos,true);
          echo Vista::mostrar('./plantilla/aside1.php',$datos,true); 
          break;
        default:
        echo Vista::mostrar('./plantilla/nav1.php',$datos,true);
        echo Vista::mostrar('./plantilla/aside1.php',$datos,true); 
          break;
      }
    ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo Vista::mostrar('./plantilla/wrapper.php',$datos,true); ?>
    <?php echo $contenido; ?>
  </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
    <?php echo Vista::mostrar('./plantilla/footer.php',$datos,true); ?>
    <?php echo Vista::mostrar('./plantilla/js.php',$dataJS,true); 
    if (isset($grafico))
     echo Vista::mostrar('./plantilla/jsEstadisticas.php',$grafico,true); 
    
    // var_dump($js);exit();
    if (isset($js))
      foreach ($js as $j) { ?>
        <script src="<?=$j['url']?>"></script>
     <?php }
    ?>
</body>
</html>