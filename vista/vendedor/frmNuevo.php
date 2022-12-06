<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlVendedor&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputID" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="id" value="" id="inputID">
        </div>
        <div class="col-md-6">
            <label for="inputvendedor" class="form-label">Nombre:</label>
            <input type="text" class="form-control"
                name="nombres" value="" id="inputvendedor">
        </div>
        <div class="col-md-6">
            <label for="inputvendedor" class="form-label">Apellidos:</label>
            <input type="text" class="form-control"
                name="apellidos" value="" id="inputvendedor">
        </div>
        <div class="col-md-6">
            <label for="inputvendedor" class="form-label">DNI:</label>
            <input type="text" class="form-control"
                name="dni" value="" id="inputvendedor">
        </div>
        <div class="col-md-6">
            <label for="inputvendedor" class="form-label">Direccion:</label>
            <input type="text" class="form-control"
                name="direccion" value="" id="inputvendedor">
        </div>
        <div class="col-md-6">
            <label for="inputvendedor" class="form-label">Telefono:</label>
            <input type="text" class="form-control"
                name="telefono" value="" id="inputvendedor">
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Guardar</button>
        </div>
    </form>

</div>
</section>
