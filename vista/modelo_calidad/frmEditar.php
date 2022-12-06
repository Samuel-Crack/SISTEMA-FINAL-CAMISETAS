<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlModelo_calidad&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="id" value="<?=$modelo_calidad->getId()?>" 
                class="form-control">
        </div>

        <div class="col-md-6">
            <label for="inputmodelo" class="form-label">Modelos:</label>
            <select class="form-control" name="modelo" id="modelo">
                <?php 
                $modelos= $modelo_calidad->getModelos()->leer()['data'];
                $modelo = $modelo_calidad->getModelos()->getId();
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
            <label for="inputcalidad" class="form-label">Calidad:</label>
            <select class="form-control" name="calidad" id="calidad">
                <?php 
                $calidades= $modelo_calidad->getCalidad()->leer()['data'];
                $calidad = $modelo_calidad->getCalidad()->getId();
                foreach ($calidades as $p) {
                    if ($p["idcalidad"]==$calidad) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['idcalidad']?>"><?=$p['calidad']?></option>
                <?php } ?>

            </select>
            
        </div>
        <div class="col-md-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlModelo_calidad" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
