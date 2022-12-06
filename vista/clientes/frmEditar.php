<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlClientes&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="id" value="<?=$clientes->getId()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Nombres:</span>
            <input type="text" name="nombres" value="<?=$clientes->getNombres()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Apellidos:</span>
            <input type="text" name="apellidos" value="<?=$clientes->getApellidos()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Dni:</span>
            <input type="text" name="dni" value="<?=$clientes->getDni()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Telefono:</span>
            <input type="text" name="telefono" value="<?=$clientes->getTelefono()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Direccion:</span>
            <input type="text" name="direccion" value="<?=$clientes->getDireccion()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Nacionalidad:</span>
            <input type="text" name="nacionalidad" value="<?=$clientes->getNacionalidad()?>" 
                class="form-control">
        </div>

        <div class="col-6">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
            
        </form>
        <br><a href="?ctrl=CtrlBoletas" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
    </div>
</section>