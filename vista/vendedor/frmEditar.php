<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlVendedor&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="id" value="<?=$vendedor->getId()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Nombres:</span>
            <input type="text" name="nombres" value="<?=$vendedor->getNombres()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Apellidos:</span>
            <input type="text" name="apellidos" value="<?=$vendedor->getApellidos()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Dni:</span>
            <input type="text" name="dni" value="<?=$vendedor->getDni()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Telefono:</span>
            <input type="text" name="telefono" value="<?=$vendedor->getTelefono()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Direccion:</span>
            <input type="text" name="direccion" value="<?=$vendedor->getDireccion()?>" 
                class="form-control">
        </div>
        <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>
                <div class="col-md-4"></div>
                
            </div>
            
        </form>
    </div>
</section>

