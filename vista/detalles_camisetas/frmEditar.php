<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlDetalles_camisetas&accion=guardarEditar" method="post">
    <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="id" value="<?=$detalles_camisetas->getId()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Precio:</span>
            <input type="text" name="precio" value="<?=$detalles_camisetas->getPrecio()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Stock:</span>
            <input type="text" name="stock" value="<?=$detalles_camisetas->getStock()?>" 
                class="form-control">
        </div>
        <div class="col-md-6">
            <label for="inputcamisetas" class="form-label">Camisetas:</label>
            <select class="form-control" name="camisetas" id="camisetas">
                <?php 
                $camiseta = $detalles_camisetas->getCamisetas()->leer()['data'];
                $camisetas = $detalles_camisetas->getCamisetas()->getId();
                foreach ($camiseta as $p) {
                    if ($p["idcamisetas"]==$camisetas) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['idcamisetas']?>"><?=$p['descripcion']?></option>
                <?php } ?>

            </select>
            
        </div>

        <div class="col-md-6">
            <label for="inputmodelo_talla" class="form-label">Modelo Talla:</label>
            <select class="form-control" name="modelo_talla" id="modelo_talla">
                <?php 
                $modelo_tallas = $detalles_camisetas->getModelo_talla()->leer()['data'];
                $modelo_talla = $detalles_camisetas->getModelo_talla()->getId();
                foreach ($modelo_tallas as $p) {
                    if ($p["idmodelo_talla"]==$modelo_talla) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['idmodelo_talla']?>"><?=$p['talla']?></option>
                <?php } ?>

            </select>
            
        </div>

        <div class="col-md-6">
            <label for="inputmodelo_seleccion" class="form-label">Modelo Seleccion:</label>
            <select class="form-control" name="modelo_seleccion" id="modelo_seleccion">
                <?php 
                $modelo_selecciones = $detalles_camisetas->getModelo_seleccion()->leer()['data'];
                $modelo_seleccion = $detalles_camisetas->getModelo_seleccion()->getId();
                foreach ($modelo_selecciones as $p) {
                    if ($p["idmodelo_seleccion"]==$modelo_seleccion) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['idmodelo_seleccion']?>"><?=$p['seleccion']?></option>
                <?php } ?>

            </select>
            
        </div>

        <div class="col-md-6">
            <label for="inputmodelo_calidad" class="form-label">Modelo Calidad:</label>
            <select class="form-control" name="modelo_calidad" id="modelo_calidad">
                <?php 
                $modelo_calidades = $detalles_camisetas->getModelo_calidad()->leer()['data'];
                $modelo_calidad = $detalles_camisetas->getModelo_calidad()->getId();
                foreach ($modelo_calidades as $p) {
                    if ($p["idmodelo_calidad"]==$modelo_calidad) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['idmodelo_calidad']?>"><?=$p['calidad']?></option>
                <?php } ?>

            </select>
            
        </div>

        <div class="col-md-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlDetalles_camisetas" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
