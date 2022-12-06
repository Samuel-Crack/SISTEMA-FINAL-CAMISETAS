<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlModelo_seleccion&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputID" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="id" value="" id="inputID">
        </div>
        <div class="col-md-6">
            <label for="inputModelo_seleccion" class="form-label">Descripcion:</label>
            <input type="text" class="form-control"
                name="descripcion" value="" id="inputModelo_seleccion">
        </div>
        <div class="col-md-6">
            <label for="inputModelo_seleccion" class="form-label">Color:</label>
            <input type="text" class="form-control"
                name="color" value="" id="inputModelo_seleccion">
        </div>
        <div class="col-md-6">
            <label for="inputmodelos" class="form-label">Modelo:</label>
            <select class="form-control" name="modelos" id="modelo">
                <?php 
                $modelos= $modelo_seleccion->getModelos()->leer()['data'];
                foreach ($modelos as $p) {
                ?>
                <option value="<?=$p['idmodelos']?>"><?=$p['modelo']?></option>
                <?php } ?>

            </select>
            
        </div>

        <div class="col-md-6">
            <label for="inputseleccion" class="form-label">Seleccion:</label>
            <select class="form-control" name="seleccion" id="seleccion">
                <?php 
                $seleccion= $modelo_seleccion->getSeleccion()->leer()['data'];
                foreach ($seleccion as $p) {
                ?>
                <option value="<?=$p['idseleccion']?>"><?=$p['seleccion']?></option>
                <?php } ?>

            </select>
            
        </div>
        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlModelo_seleccion" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>