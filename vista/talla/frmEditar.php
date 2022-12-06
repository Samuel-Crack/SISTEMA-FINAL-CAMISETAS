<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlTalla&accion=guardarEditar" method="post"> 
        <div class="input-group mb-3"> 
            <span class="input-group-text">Id:</span> 
            <input type="text" name="id" value="<?=$talla->getId()?>" 
            class="form-control"> 
        </div> 
        <div class="input-group mb-3"> 
            <span class="input-group-text">Talla:</span> 
            <input type="text" name="talla" value="<?=$talla->getTalla()?>" 
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
