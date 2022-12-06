<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlModelo_calidad&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputID" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="id" value="" id="inputID">
        </div>

        <div class="col-md-6">
            <label for="inputmodelos" class="form-label">Modelo:</label>
            <select class="form-control" name="modelos" id="modelo">
                <?php 
                $modelos= $modelo_calidad->getModelos()->leer()['data'];
                foreach ($modelos as $p) {
                ?>
                <option value="<?=$p['idmodelos']?>"><?=$p['modelo']?></option>
                <?php } ?>

            </select>
            
        </div>


        <div class="col-md-6">
            <label for="inputcalidad" class="form-label">Calidad:</label>
            <select class="form-control" name="calidad" id="calidad">
                <?php 
                $calidad= $modelo_calidad->getCalidad()->leer()['data'];
                foreach ($calidad as $p) {
                ?>
                <option value="<?=$p['idcalidad']?>"><?=$p['calidad']?></option>
                <?php } ?>

            </select>
            
        </div>
        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlModelo_calidad" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>