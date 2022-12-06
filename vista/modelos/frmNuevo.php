<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlModelos&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputID" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="id" value="" id="inputID">
        </div>
        <div class="col-md-6">
            <label for="inputModelos" class="form-label">Modelo:</label>
            <input type="text" class="form-control"
                name="modelo" value="" id="inputModelos">
        </div>
        <div class="col-md-6">
            <label for="inputmarca" class="form-label">Marca:</label>
            <select class="form-control" name="marca" id="marca">
                <?php 
                $marcas= $modelos->getMarca()->leer()['data'];
                foreach ($marcas as $p) {
                ?>
                <option value="<?=$p['idmarca']?>"><?=$p['marca']?></option>
                <?php } ?>

            </select>
            
        </div>
        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlModelos" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>