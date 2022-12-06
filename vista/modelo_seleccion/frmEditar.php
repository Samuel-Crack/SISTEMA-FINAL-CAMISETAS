<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlModelo_seleccion&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="id" value="<?=$modelo_seleccion->getId()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Descripcion:</span>
            <input type="text" name="descripcion" value="<?=$modelo_seleccion->getDescripcion()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Color:</span>
            <input type="text" name="color" value="<?=$modelo_seleccion->getColor()?>" 
                class="form-control">
        </div>

        <div class="col-md-6">
            <label for="inputmodelo" class="form-label">Modelos:</label>
            <select class="form-control" name="modelo" id="modelo">
                <?php 
                $modelos= $modelo_seleccion->getModelos()->leer()['data'];
                $modelo = $modelo_seleccion->getModelos()->getId();
                foreach ($modelos as $p) {
                    if ($p["idmodelos"]==$modelo) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['idmodelos']?>"><?=$p['modelo']?></option>
                <?php } ?>

            </select>
            
        </div>


        <div class="col-md-6">
            <label for="inputseleccion" class="form-label">Seleccion:</label>
            <select class="form-control" name="seleccion" id="seleccion">
                <?php 
                $selecciones= $modelo_seleccion->getSeleccion()->leer()['data'];
                $seleccion = $modelo_seleccion->getSeleccion()->getId();
                foreach ($selecciones as $p) {
                    if ($p["idseleccion"]==$seleccion) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['idseleccion']?>"><?=$p['seleccion']?></option>
                <?php } ?>

            </select>
            
        </div>
        <div class="col-md-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlModelo_seleccion" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
