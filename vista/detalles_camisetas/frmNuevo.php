<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlDetalles_camisetas&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputID" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="id" value="" id="inputID">
        </div>
        <div class="col-md-6">
            <label for="inputdetalles_camisetas" class="form-label">Precio:</label>
            <input type="text" class="form-control"
                name="precio" value="" id="inputdetalles_camisetas">
        </div>
        <div class="col-md-6">
            <label for="inputdetalles_camisetas" class="form-label">Stock:</label>
            <input type="text" class="form-control"
                name="stock" value="" id="inputdetalles_camisetas">
        </div>
        <div class="col-md-6">
            <label for="inputcamisetas" class="form-label">Camisetas:</label>
            <select class="form-control" name="camisetas" id="camisetas">
                <?php 
                $camisetas= $detalles_camisetas->getCamisetas()->leer()['data'];
                foreach ($camisetas as $p) {
                ?>
                <option value="<?=$p['idcamisetas']?>"><?=$p['descripcion']?></option>
                <?php } ?>

            </select>
            
        </div>

        <div class="col-md-6">
            <label for="inputmodelo_talla" class="form-label">Modelo Talla:</label>
            <select class="form-control" name="modelo_talla" id="modelo_talla">
                <?php 
                $modelo_talla= $detalles_camisetas->getModelo_talla()->leer()['data'];
                foreach ($modelo_talla as $p) {
                ?>
                <option value="<?=$p['idmodelo_talla']?>"><?=$p['talla']?></option>
                <?php } ?>

            </select>
            
        </div>

        <div class="col-md-6">
            <label for="inputmodelo_seleccion" class="form-label">Modelo Seleccion:</label>
            <select class="form-control" name="modelo_seleccion" id="modelo_seleccion">
                <?php 
                $modelo_seleccion= $detalles_camisetas->getModelo_seleccion()->leer()['data'];
                foreach ($modelo_seleccion as $p) {
                ?>
                <option value="<?=$p['idmodelo_seleccion']?>"><?=$p['seleccion']?></option>
                <?php } ?>

            </select>
            
        </div>

        <div class="col-md-6">
            <label for="inputmodelo_calidad" class="form-label">Modelo Calidad:</label>
            <select class="form-control" name="modelo_calidad" id="modelo_calidad">
                <?php 
                $modelo_calidad= $detalles_camisetas->getModelo_calidad()->leer()['data'];
                foreach ($modelo_calidad as $p) {
                ?>
                <option value="<?=$p['idmodelo_calidad']?>"><?=$p['calidad']?></option>
                <?php } ?>

            </select>
            
        </div>

        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlDetalles_camisetas" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>