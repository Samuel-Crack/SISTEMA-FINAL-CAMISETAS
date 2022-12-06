<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlDetalle_boleta&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="id" value="<?=$detalle_boleta->getId()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Cantidad:</span>
            <input type="text" name="cantidad" value="<?=$detalle_boleta->getCantidad()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Precio Unitario:</span>
            <input type="text" name="precio_unitario" value="<?=$detalle_boleta->getPrecio_unitario()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Subtotal:</span>
            <input type="text" name="subtotal" value="<?=$detalle_boleta->getSubtotal()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Producto:</span>
            <input type="text" name="producto" value="<?=$detalle_boleta->getProducto()?>" 
                class="form-control">
        </div>


        <div class="col-md-6">
            <label for="inputboletas" class="form-label">Boletas (Total):</label>
            <select class="form-control" name="boletas" id="boletas">
                <?php 
                $boleta= $detalle_boleta->getBoletas()->leer()['data'];
                $boletas = $detalle_boleta->getBoletas()->getId();
                foreach ($boleta as $p) {
                    if ($p["idboletas"]==$boletas) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['idboletas']?>"><?=$p['total']?></option>
                <?php } ?>

            </select>
            
        </div>

        <div class="col-md-6">
            <label for="inputdetalles_camisetas" class="form-label">Detalles Camisetas (Stock):</label>
            <select class="form-control" name="detalles_camisetas" id="detalles_camisetas">
                <?php 
                $detalles_camiseta= $detalle_boleta->getDetalles_camisetas()->leer()['data'];
                $detalles_camisetas = $detalle_boleta->getDetalles_camisetas()->getId();
                foreach ($detalles_camiseta as $p) {
                    if ($p["iddetalles_camisetas"]==$detalles_camisetas) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['iddetalles_camisetas']?>"><?=$p['stock']?></option>
                <?php } ?>

            </select>
            
        </div>


        <div class="col-md-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlDetalle_boleta" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
