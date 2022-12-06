<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlModelo_talla&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="id" value="<?=$modelo_talla->getId()?>" 
                class="form-control">
        </div>

        <div class="col-md-6">
            <label for="inputmodelo" class="form-label">Modelos:</label>
            <select class="form-control" name="modelo" id="modelo">
                <?php 
                $modelos= $modelo_talla->getModelos()->leer()['data'];
                $modelo = $modelo_talla->getModelos()->getId();
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
            <label for="inputtalla" class="form-label">Talla:</label>
            <select class="form-control" name="talla" id="talla">
                <?php 
                $tallas= $modelo_talla->getTalla()->leer()['data'];
                $talla = $modelo_talla->getTalla()->getId();
                foreach ($tallas as $p) {
                    if ($p["idtalla"]==$talla) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['idtalla']?>"><?=$p['talla']?></option>
                <?php } ?>

            </select>
            
        </div>
        <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Guardar
                    </button>
            </div>
            
        </form>
    </div>
</section>