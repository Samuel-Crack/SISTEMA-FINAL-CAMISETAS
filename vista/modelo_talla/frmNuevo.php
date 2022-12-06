<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlModelo_talla&accion=guardarNuevo" method="post">
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
                $modelos= $modelo_talla->getModelos()->leer()['data'];
                foreach ($modelos as $p) {
                ?>
                <option value="<?=$p['idmodelos']?>"><?=$p['modelo']?></option>
                <?php } ?>

            </select>
            
        </div>



        <div class="col-md-6">
            <label for="inputtalla" class="form-label">Talla:</label>
            <select class="form-control" name="talla" id="talla">
                <?php 
                $talla= $modelo_talla->getTalla()->leer()['data'];
                foreach ($talla as $p) {
                ?>
                <option value="<?=$p['idtalla']?>"><?=$p['talla']?></option>
                <?php } ?>

            </select>
            
        </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Guardar</button>
        </div>
    </form>

</div>
</section>