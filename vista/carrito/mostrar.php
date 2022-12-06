<section class="content">
    <form action="?ctrl=CtrlCarrito&accion=agregar&url=carrito"" method="post">
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cart-plus"></i>
                        Carrito de compras
                    </h3>
                    </div>
                    <div class="card-body pad table-responsive">
                    <table class="table table-bordered text-center">
    <?php 
    $total =0;
    // var_dump($data);exit();
    if (isset($_SESSION['carrito']))
        foreach ($data as $p) { 
            $cant = $_SESSION['carrito']->getCantidad($p['iddetalles_camisetas']);
            $img = $_SESSION['carrito']->getImg($p['iddetalles_camisetas']);
            $talla = $_SESSION['carrito']->getTalla($p['iddetalles_camisetas']);
            
            $precio = $p['precio'];
            $subTotal = number_format($cant * $precio, 2, ',', ' ');
            $total += $cant * $precio;
            ?>
                     
                        <tbody>
                            <tr>
                                <td width="20%">
                                    <img src="recursos/images/catalogo/<?=$img?>" alt="user-avatar" class="img-fluid">
                                    <hr>
                                    <a href="?ctrl=CtrlCarrito&accion=sacar&id=<?=$p['iddetalles_camisetas']?>&url=carrito&cant=<?=$cant?>" class="btn btn-danger">Eliminar</a>
                                    <input type="hidden" name="img" id="imgSeleccionada" value="<?=$img?>">
                                    <input type="hidden" name="id"  value="<?=$p['iddetalles_camisetas']?>">
                                    <input type="hidden" name="talla"  value="<?=$talla?>">
                                </td>
                                <td>
                                    <h2><?=$p['camiseta']?></h2>
                                    <h5><code><?=$p['descripcion']?></code> </h5>
                                    <br><br>
                                    <h4>Calidad: <code><?=$p['calidad']?></code> </h4>
                                    <h4>Modelo: <code><?=$p['modelo']?></code> </h4>
                                    <h4>Talla: <code><?=$talla?></code> </h4>
                                </td>
                                <td width="20%">
                                    <h5>Precio:</h5>
                                        <h4>S/ <?=number_format($precio, 2, ',', ' ');?></h4> 
                                    <h5>Cantidad:</h5>
                                        <h4>
                                            <?=$cant;?>
                                            <input type="submit" class="btn btn-primary" value="+">
                                            <a href="?ctrl=CtrlCarrito&accion=sacar&id=<?=$p['iddetalles_camisetas']?>&url=carrito"
                                                 class="btn btn-danger">-</a>
                                        </h4>
                                        
                                    <h4>Sub Total: </h4>
                                    <h4>
                                        <?=$subTotal;?>
                                    </h4>
                                </td>
                            </tr>
                        </tbody>
   <?php }
        ?>                     
                    </table>
                    </div>
                    <!-- /.card -->
                </div>

        </div>
        <!-- /.col -->
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-cart-plus"></i>
                    Resumen
                </h3>
                </div>
                <div class="card-body pad table-responsive">
                
                <table class="table table-bordered text-center">
                    
                    <tbody>
                        <tr>
                            <td>
                                <h4>Total Productos:</h4>
                            
                                S/ <?=number_format($total, 2, ',', ' ');?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>IGV.:</h3> 
                            
                                S/ <?=number_format($total*0.18, 2, ',', ' ');?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Total</h3> 
                            
                                <h4>
                                    S/ <?=number_format($total*1.18, 2, ',', ' ');?>
                                </h4>
                                
                            </td>
                        </tr>
                    </tbody>
                    
                </table>
                <hr>
                <?php if (isset($_SESSION['id'])){ ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            
                            <a href="?ctrl=CtrlBoletas&accion=guardarNuevo" class="btn-lg btn-success">
                                <i class="fa fa-cart-arrow-down"></i>
                            Procesar Compra</a>
                        </div>
                    </div>
                <?php }else { ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            
                            <button class="btn-lg btn-success" disabled>
                                <i class="fa fa-cart-arrow-down"></i>
                            Procesar Compra</button>
                            <br>
                            <code>Primero debe LOGEARSE</code>
                        </div>
                    </div>
                <?php }?>
                
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        
                        
                        <a href="?ctrl=CtrlDetalles_camisetas&accion=getCatalogo" 
                            class="btn-lg btn-primary">
                            <i class="fa fa-store"></i>
                            Seguir comprando</a>
                    </div>
                </div>
                
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
        <!-- ./row -->
        </form>
</section>
    