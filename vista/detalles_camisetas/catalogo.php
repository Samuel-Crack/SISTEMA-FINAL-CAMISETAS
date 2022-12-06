<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
    <div class="card-body pb-0">
        <div class="row">
    <?php
        if (is_array($data)){
          foreach ($data as $d) {
            ?>
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                Producto exclusivo
            </div>
            <div class="card-body pt-0">
                <div class="row">
                <div class="col-7">
                <h2 class="lead"><b><?=$d['camiseta']?></b></h2>
                    <p class="text-muted text-sm"><b>Seleccion: </b><?=$d['seleccion']?></p>
                    <p class="text-muted text-sm"><b>Descripcion: </b><?=$d['descripcion']?></p>
                    
                    <h3 class="text-red">S/ <?=number_format($d['precio'], 2, ',', ' ');?></h3>
                </div>
                <div class="col-5 text-center">
                    <?php 
                        $img = (!is_null($d['url']))?$d['url']:'SIN_IMAGEN.jpg';
                    ?>
                    <img src="recursos/images/catalogo/<?=$img?>" alt="user-avatar" class="img-circle img-fluid">
                </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                
                <a href="?ctrl=CtrlDetalles_camisetas&accion=verDetalles&id=<?=$d['iddetalles_camisetas']?>&url=catalogo" class="btn btn-sm btn-success">
                    <i class="fas fa-user"></i> Ver detalles
                </a>
                
                </div>
            </div>
            </div>
        </div>
     <?php
          }  
        }else{
            echo "no hay productos";
        }
    ?>

        </div>
    </div>
    </div>
</section>