<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlDetalle_boleta&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputID" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="id" value="" id="inputID">
        </div>
        <div class="col-md-6">
            <label for="inputdetalle_boleta" class="form-label">Cantidad:</label>
            <input type="text" class="form-control"
                name="cantidad" value="" id="inputdetalle_boleta">
        </div>
        <div class="col-md-6">
            <label for="inputdetalle_boleta" class="form-label">Precio Unitario:</label>
            <input type="text" class="form-control"
                name="precio_unitario" value="" id="inputdetalle_boleta">
        </div>
        <div class="col-md-6">
            <label for="inputdetalle_boleta" class="form-label">Subtotal:</label>
            <input type="text" class="form-control"
                name="subtotal" value="" id="inputdetalle_boleta">
        </div>
        <div class="col-md-6">
            <label for="inputdetalle_boleta" class="form-label">Producto:</label>
            <input type="text" class="form-control"
                name="producto" value="" id="inputdetalle_boleta">
        </div>
   
        <div class="col-md-6">
            <label for="inputboletas" class="form-label">Boletas (total):</label>
            <select class="form-control" name="boletas" id="boletas">
                <?php 
                $boletas= $detalle_boleta->getBoletas()->leer()['data'];
                foreach ($boletas as $p) {
                ?>
                <option value="<?=$p['idboletas']?>"><?=$p['total']?></option>
                <?php } ?>

            </select>
            
        </div>

        <div class="col-md-6">
            <label for="inputdetalles_camisetas" class="form-label">Detalles Camisetas (stock):</label>
            <select class="form-control" name="detalles_camisetas" id="detalles_camisetas">
                <?php 
                $detalles_camisetas= $detalle_boleta->getDetalles_camisetas()->leer()['data'];
                foreach ($detalles_camisetas as $p) {
                ?>
                <option value="<?=$p['iddetalles_camisetas']?>"><?=$p['stock']?></option>
                <?php } ?>

            </select>
            
        </div>

        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlDetalle_boleta" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>