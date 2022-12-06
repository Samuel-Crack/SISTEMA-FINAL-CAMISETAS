<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlBoletas&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="id" value="<?=$boletas->getId()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Numero:</span>
            <input type="text" name="numero" value="<?=$boletas->getNumero()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Fecha:</span>
            <input type="text" name="fecha" value="<?=$boletas->getFecha()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Total:</span>
            <input type="text" name="total" value="<?=$boletas->getTotal()?>" 
                class="form-control">
        </div>
        <div class="col-md-6">
            <label for="inputclientes" class="form-label">Clientes:</label>
            <select class="form-control" name="clientes" id="clientes">
                <?php 
                $cliente = $boletas->getClientes()->leer()['data'];
                $clientes = $boletas->getClientes()->getId();
                foreach ($cliente as $p) {
                    if ($p["idclientes"]==$clientes) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['idclientes']?>"><?=$p['nombres']?></option>
                <?php } ?>

            </select>
            
        </div>



        <div class="col-md-6">
            <label for="inputvendedor" class="form-label">Vendedor:</label>
            <select class="form-control" name="vendedor" id="vendedor">
                <?php 
                $vendedores = $boletas->getVendedor()->leer()['data'];
                $vendedor = $boletas->getVendedor()->getId();
                foreach ($vendedores as $p) {
                    if ($p["idvendedor"]==$vendedor) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$p['idvendedor']?>"><?=$p['nombres']?></option>
                <?php } ?>

            </select>
            
        </div>




        <div class="col-md-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlBoletas" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
