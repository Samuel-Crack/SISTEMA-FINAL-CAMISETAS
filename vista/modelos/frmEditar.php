<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlModelos&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="id" value="<?=$modelos->getId()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Modelo:</span>
            <input type="text" name="modelo" value="<?=$modelos->getModelo()?>" 
                class="form-control">
        </div>
        <div class="col-md-6">
            <label for="inputmarca" class="form-label">Marca:</label>
            <select class="form-control" name="marca" id="marca">
                <?php 
                $marca= $modelos->getMarca()->leer()['data'];
                $marcas = $modelos->getMarca()->getId();
                foreach ($marca as $p) {
                    if ($p["idmarca"]==$marca) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['idmarca']?>"><?=$p['marca']?></option>
                <?php } ?>

            </select>
            
        </div>
        <div class="col-md-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlModelos" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
