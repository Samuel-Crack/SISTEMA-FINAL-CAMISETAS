<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlImagenes_producto&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputID" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="id" value="" id="inputID">
        </div>
        <div class="col-md-6">
            <label for="inputimagenes_producto" class="form-label">Url:</label>
            <input type="text" class="form-control"
                name="url" value="" id="inputimagenes_producto">
        </div>
        <div class="col-md-6">
            <label for="inputimagenes_producto" class="form-label">Nombre:</label>
            <input type="text" class="form-control"
                name="nombre" value="" id="inputimagenes_producto">
        </div>
        <div class="col-md-6">
            <label for="inputdetalles_camisetas" class="form-label">Detalles Camisetas:</label>
            <select class="form-control" name="detalles_camisetas" id="detalles_camisetas">
                <?php 
                $detalles_camisetas= $imagenes_producto->getDetalles_camisetas()->leer()['data'];
                foreach ($detalles_camisetas as $p) {
                ?>
                <option value="<?=$p['iddetalles_camisetas']?>"><?=$p['iddetalles_camisetas']?></option>
                <?php } ?>

            </select>
            
        </div>
        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlImagenes_producto" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>