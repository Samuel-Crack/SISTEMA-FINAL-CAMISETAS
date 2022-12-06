<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlMarca&accion=guardarEditar" method="post"> 
        <div class="input-group mb-3"> 
            <span class="input-group-text">Id:</span> 
            <input type="text" name="id" value="<?=$marca->getId()?>" 
            class="form-control"> 
        </div> 
        <div class="input-group mb-3"> 
            <span class="input-group-text">Marca:</span> 
            <input type="text" name="marca" value="<?=$marca->getMarca()?>" 
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
