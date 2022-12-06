<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlBoletas&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputID" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="id" value="" id="inputID">
        </div>
        <div class="col-md-6">
            <label for="inputboletas" class="form-label">Numero:</label>
            <input type="text" class="form-control"
                name="numero" value="" id="inputboletas">
        </div>
        <div class="col-md-6">
            <label for="inputboletas" class="form-label">Fecha:</label>
            <input type="text" class="form-control"
                name="fecha" value="" id="inputboletas">
        </div>
        <div class="col-md-6">
            <label for="inputboletas" class="form-label">Total:</label>
            <input type="text" class="form-control"
                name="total" value="" id="inputboletas">
        </div>
        <div class="col-md-6">
            <label for="inputclientes" class="form-label">Clientes:</label>
            <select class="form-control" name="clientes" id="clientes">
                <?php 
                $clientes= $boletas->getClientes()->leer()['data'];
                foreach ($clientes as $p) {
                ?>
                <option value="<?=$p['idclientes']?>"><?=$p['nombres']?></option>
                <?php } ?>

            </select>
            
        </div>


        <div class="col-md-6">
            <label for="inputvendedor" class="form-label">Vendedor:</label>
            <select class="form-control" name="vendedor" id="vendedor">
                <?php 
                $vendedor= $boletas->getVendedor()->leer()['data'];
                foreach ($vendedor as $p) {
                ?>
                <option value="<?=$p['idvendedor']?>"><?=$p['nombres']?></option>
                <?php } ?>

            </select>
            
        </div>

        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlBoletas" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>