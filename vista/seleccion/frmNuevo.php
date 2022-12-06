<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlSeleccion&accion=guardarNuevo" method="post"> 
        <div class="row mb-3">
        <div class="col-md-6">
        <label for="inputID" class="form-label">Id:</label> 
        <input type="text" class="form-control" name="id" value="" id="inputID"> 
    </div> 
    <div class="col-md-6"> 
        <label for="inputseleccion" class="form-label">Seleccion:</label> 
        <input type="text" class="form-control" name="seleccion" value="" id="inputseleccion"> 
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